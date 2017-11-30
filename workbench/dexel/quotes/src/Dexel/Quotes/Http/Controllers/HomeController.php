<?php namespace Dexel\Quotes\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dexel\Quotes\Facades\Quotes;

/**
 * The HomeController facade.
 *
 * @package Dexel\Quotes\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class HomeController extends Controller
{
    public function demo()
    {
        return Quotes::welcome();
    }
}
