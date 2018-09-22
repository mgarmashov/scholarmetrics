<?php

namespace App\Http\Controllers;

use App\Models\Schools;
use Illuminate\Http\Request;
use App\Models\Cites;

/**
 * This class is used for showing data by shortlink.
 * New - because there is used new format of link
 *
 */
class NewPersonController extends MetricsController
{

    public function getList(Request $request)
    {
        $this->cites = $this->getPersonData();
        $this->responseData = $this->getPersonsInfo();

        return view('components.metrics-shortlink-response', ['data' => $this->responseData]);

    }

    protected  function getPersonData()
    {
        $model = new Cites;
        return $model->where('shortlink', request()->shortlink)->get();
    }

}
