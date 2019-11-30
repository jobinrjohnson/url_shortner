<?php

namespace App\Http\Controllers;

use App\Helpers\ShortenHelper;
use App\Http\Requests\ShortenRequest;
use App\Shortner;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function shorten(ShortenRequest $request)
    {

        $request->validated();

        $url = $request->input('link');
        if (($shortned = Shortner::isLinkAlreadyExistsInDB($url)) == false) {
            $shortened = (new ShortenHelper())->generateKey();
            $obj = Shortner::storeUrl($url, $shortened);
            return $obj;
        }

        return $shortned;
    }
}
