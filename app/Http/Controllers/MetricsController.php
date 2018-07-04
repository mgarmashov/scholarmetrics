<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cites;

class MetricsController extends Controller
{
    //
    public function getList(Request $request)
    {
        $searchType = $request->searchType;
        $textValue = $request->textValue;

    return view('components.metrics-list');
    }
}
