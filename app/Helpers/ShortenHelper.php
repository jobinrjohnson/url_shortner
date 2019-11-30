<?php

namespace App\Helpers;

class ShortenHelper
{
    public function generateKey()
    {
        $short_url = "";
        do {
            $short_url = substr(uniqid(),0,5);
        } while (false);
        return $short_url;
    }
}
