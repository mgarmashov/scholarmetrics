<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Schools;
use Illuminate\Http\Request;
use App\Models\Cites;
use GuzzleHttp\Client;


class HistoryWriteController extends Controller
{

    public function init(Request $request)
    {

        $history = new History;
        $history->name = $request->name;
        $history->type = $request->type;
        $history->ip_address = $request->ip();



        if($request->ip() != '127.0.0.1' && $request->ip() != 'localhost'){
            $client = new Client();
            $res = $client->get('http://ip-api.com/json/'.$request->ip());
            //        $res->getStatusCode(); // 200

            $clientInfo = json_decode((string) $res->getBody())  ?? '';
//            dd($clientInfo);
            //        dd('http://ip-api.com/json/'.$request->ip(), $clientInfo);
//            dd($clientInfo->country);
            $output = [];
            $history->country_name = $clientInfo->country ?? '';
            $history->country_code = $clientInfo->countryCode ?? '';
            $history->state = $clientInfo->regionName ?? '';

            $history->save();

            return response()->json("We wrote: $clientInfo->country ($clientInfo->countryCode), $clientInfo->regionName",200);
        }




        $history->save();

        return response()->json("Unable to write location",200);

    }

}
