<?php

namespace App\Helpers;

class ShortenHelper
{
    public function generateKey()
    {
        $short_url = "";
        do {
            $short_url = base_convert(time(), 10, 36).''.rand(0,9);
        } while (false);
        return $short_url;
    }
}
