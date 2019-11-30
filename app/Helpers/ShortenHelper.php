<?php

namespace App\Helpers;

class ShortenHelper
{
    public function generateKey()
    {
        $short_url = "";
        do {
            $short_url = uniqid();
        } while (false);
        return $short_url;
    }
}
