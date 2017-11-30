<?php namespace Dexel\Videos\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dexel\Videos\Facades\Videos;

/**
 * The HomeController facade.
 *
 * @package Dexel\Videos\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class HomeController extends Controller
{
  public function index()
   {
       return view('videos::index');
   }
   public function viewvideo()
    {
        return view('videos::view');
    }
}
