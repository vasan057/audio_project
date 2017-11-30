<?php namespace Dexel\Quotes\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes;

/**
 * The HomeController facade.
 *
 * @package Dexel\Quotes\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class HomeController extends Controller
{
    public function index()
    {
        $quotes = Quotes::select('description','author','cover_img','created_at')->where(['active'=>'1'])->get();
        return api_response('3000','success','quotes',$quotes);
    }
}
