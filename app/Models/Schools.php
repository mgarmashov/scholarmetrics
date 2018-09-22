<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schools extends Model
{
    public static function schoolRank($schoolName)
    {
        return self::where('name', $schoolName)->first()['rank'];
    }
}
