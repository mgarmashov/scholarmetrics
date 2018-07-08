<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schools extends Model
{
//    protected $guarded = ['schoolRank'];

    public static function schoolRank($schoolName){
//        dd($schoolName);
//        dd(self::where('name', $schoolName)->first()->rank);
//        $schoolRank = self::where('name', $schoolName);
//        $schoolRank = $schoolRank->first();
////        dd($schoolRank->rank);
//        $schoolRank = $schoolRank['rank'];
//        return $schoolRank;
        return self::where('name', $schoolName)->first()['rank'];
    }
}
