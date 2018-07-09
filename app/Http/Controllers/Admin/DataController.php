<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\Cites;
use App\Models\Schools;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function showPage(Request $request)
    {

        $data = [];

        if($request->sheet == 'cites'){
            $data['Cites'] = $this->getData('Cites');
        } elseif($request->sheet == 'schools'){
            $data['Current Schools'] = $this->getData('Schools');
        } else {
            $data['Cites'] = $this->getData('Cites');
            $data['Current Schools'] = $this->getData('Schools');
        }
//dd($data);
        return view('admin.page-data', ['data' => $data]);
    }

    public function getData($model)
    {
        $fullModel = 'App\Models\\'.$model;
        $data = $fullModel::all();

        $configName = $model == 'Cites' ? 'Cites' : 'Current Schools';
        $output = [];
        foreach ($data as $row){
            if ($model == 'Cites'){
                $output[$row->id]['shortlink'] = $row->shortlink;
            }

            foreach( $row->getAttributes() as $dbName => $value){
                if($dbName == 'id'){
                    continue;
                }

                foreach (config('excelColumns')[$configName] as $column ){
                    if ($dbName == $column['dbColumnName']){
                            $output[$row->id][$column['excelColumnName']] = $value;
                            break;
                    }
                }
            };
        }
        return $output;
    }

}
