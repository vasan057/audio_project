<?php namespace Dexel\Articles\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dexel\Articles\Facades\Articles;

/**
 * The HomeController facade.
 *
 * @package Dexel\Articles\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class HomeController extends Controller
{
    public function demo()
    {
        return Articles::welcome();
    }
}
