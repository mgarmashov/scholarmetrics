<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $guarded = [];

    public static function year(){
        return self::where('type', 'year')->first()->value ?? '';
    }

    public static function about(){
        return self::where('type', 'about')->first()->value ?? '';
    }
}
