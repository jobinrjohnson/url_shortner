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


}
