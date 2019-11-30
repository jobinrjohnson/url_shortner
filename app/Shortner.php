<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shortner extends Model
{
    protected $table = 'shortners';
    public $timestamps = false;

    protected $fillable = [
        'url_short',
        'url_original'
    ];


    public static function isLinkAlreadyExistsInDB($link)
    {
        $res = self::where('url_original', $link)->get();
        return count($res) > 0 ? $res[0] : null;
    }


    public function isKeyExistsInDB($shortned)
    {
        $res = self::where('url_short', $shortned);
        return count($res) > 0 ? $res[0] : null;
    }

    public static function storeUrl($original, $shortned)
    {
        return self::create([
            'url_original'      => $original,
            'url_short'         => $shortned
        ]);
    }
}
