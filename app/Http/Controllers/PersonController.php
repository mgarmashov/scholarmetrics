<?php

namespace App\Http\Controllers;

use App\Models\Schools;
use Illuminate\Http\Request;
use App\Models\Cites;


class PersonController extends MetricsController
{

    protected  function getPersonData()
    {
        $model = new Cites;
        return $model->where('shortlink', request()->shortlink)->get();
    }

}
