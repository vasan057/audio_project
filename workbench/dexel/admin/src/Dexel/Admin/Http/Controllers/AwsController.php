<?php namespace Dexel\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
/**
 * The AwsController facade.
 *
 * @package Dexel\Admin\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class AwsController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

	public function index()
    {
        $bucket = env('TEMP_S3_BUCKET');
        $region = env('TEMP_AWS_REGION');
        $keyStart = 'asset/';
        $acl = 'public-read';

        // These can be found on your Account page, under Security Credentials > Access Keys.
        $accessKeyId = env('TEMP_AWS_KEY');
        $secret = env('TEMP_AWS_SECRET');

        $dateString = date('Ymd');

        $credential = implode("/", array($accessKeyId, $dateString, $region, 's3/aws4_request'));
        $xAmzDate = $dateString . 'T000000Z';

        // Build policy.
        $policy = base64_encode(json_encode(array(
          // ISO 8601 - date('c'); generates uncompatible date, so better do it manually.
          'expiration' => date('Y-m-d\TH:i:s.000\Z', strtotime('+1 minutes')), // 1 minutes into the future.
          'conditions' => array(
            array('bucket' => $bucket),
            array('acl' => $acl),
            array('success_action_status' => '201'),
            array('x-requested-with' => 'xhr'),
            // Optionally control content type and file size
            // array('Content-Type' => 'application/pdf'),
            array('x-amz-algorithm' => 'AWS4-HMAC-SHA256'),
            array('x-amz-credential' => $credential),
            array('x-amz-date' => $xAmzDate),
            array('starts-with', '$key', $keyStart),
            array('starts-with', '$Content-Type', '') // Accept all files.
          )
        )));

        // Generate signature.
        $dateKey = hash_hmac('sha256', $dateString, 'AWS4' . $secret, true);
        $dateRegionKey = hash_hmac('sha256', $region, $dateKey, true);
        $dateRegionServiceKey = hash_hmac('sha256', 's3', $dateRegionKey, true);
        $signingKey = hash_hmac('sha256', 'aws4_request', $dateRegionServiceKey, true);
        $signature = hash_hmac('sha256', $policy, $signingKey, false);

        // Prepare response.
        $response = new \StdClass;
        $response->bucket = $bucket;
        $response->region = $region != 'us-east-1' ? 's3-' . $region : 's3';
        $response->keyStart = $keyStart;

        // Prepare params.
        $params = new \StdClass;
        $params->acl = $acl;
        $params->policy = $policy;
        $params->{'x-amz-algorithm'} = 'AWS4-HMAC-SHA256';
        $params->{'x-amz-credential'} = $credential;
        $params->{'x-amz-date'} = $xAmzDate;
        $params->{'x-amz-signature'} = $signature;

        // Set params in response.
        $response->params = $params;
        return json_encode($response);
    }
}
