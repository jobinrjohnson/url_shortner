<?php

namespace App\Http\Controllers;

use App\Helpers\ShortenHelper;
use App\Shortner;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function shorten(Request $request)
    {
        $url = $request->input('link');
        if (($shortned = Shortner::isLinkAlreadyExistsInDB($url)) == false) {
            $shortened = (new ShortenHelper())->generateKey();
            $obj = Shortner::storeUrl($url, $shortened);
            return $obj;
        }

        return $shortned;
    }
}
