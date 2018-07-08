<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cites;
use App\Models\Schools;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\FillChartsInformation;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class UploadExcelController extends Controller
{
    protected $file;
    protected $originalName;
    protected $filePath;
    protected $columnsTitlesOrder;
    protected $spreadsheet;
    protected $positions = ['all_positions'];


    public function showPage(){
        return view('admin.page-upload-excel');
    }

    protected function fileName(){
        return $this->file->getClientOriginalName();
    }

    protected function fileExt(){
        return $this->file->getClientOriginalExtension();
    }

    protected function filePath(){
        return $this->file->getRealPath();
    }

    protected function fileSize(){
        return $this->file->getSize();
    }

    protected function moveFile(){
        $this->originalName = $this->fileName();
        $destinationPath = 'uploads';
        $destinationName = Carbon::now()->format('Y-m-d_h-i-s') .'_'. $this->fileName();
        return $this->file = $this->file->move($destinationPath, $destinationName);
    }

    protected function sheetsTitles(){
        $sheets = [];
        foreach ($this->spreadsheet->getWorksheetIterator() as $worksheet) {
            $sheets[]=$worksheet->getTitle();
        }
        return $sheets;
    }


    protected function ifSheetsExist(){
        foreach ( array_keys(config('excelColumns')) as $sheet ){

            if( ! in_array($sheet, $this->sheetsTitles()) ){
                abort (response()->json( ['error' => 500, 'message' => "Can't find sheet '$sheet' in file ".$this->originalName ], 500));
            }
        }
        return true;
    }

    protected function defineColumnsOrder($sheet){
        $rows = $this->spreadsheet->getSheetByName($sheet)->toArray();

        foreach ( config('excelColumns')[$sheet] as $column ){
            $column = $column['excelColumnName'];
//            abort_unless(in_array($column, $rows[0]), 406, response()->json(['error' => 406, 'message' => "Can't find column '$column' in sheet '$sheet'. Names of columns should be placed at first row." ]));
            if( ! in_array($column, $rows[0])){
                abort (response()->json( ['error' => 406, 'message' => "Can't find column &laquo;<b>$column</b>&raquo; in sheet &laquo;<b>$sheet</b>&raquo;. Names of columns should be placed at first row." ], 406));
            }

            $this->columnsTitlesOrder[$sheet][$column] = array_search($column, $rows[0]);
        }
        return true;
    }

    protected function getColumnNumber($sheet, $column){
        return $this->columnsTitlesOrder[$sheet][$column] ?? null;
    }

    protected function getData($sheet, $shortlink = false){
        $data = [];
        $rows = $this->spreadsheet->getSheetByName($sheet)->toArray();
//todo сделать получение заголовка отдельной функцией
        for($i = 0; $i < count($rows); $i++){
            if(empty($rows[$i][$this->getColumnNumber($sheet, 'Name')]) && empty($rows[$i][$this->getColumnNumber($sheet, 'Planning School')])){
                continue;
            }
            if ($shortlink){
                $data[$i]['shortlink'] = preg_replace("/[^a-zA-Z0-9]+/", "",$rows[$i][ $this->getColumnNumber($sheet, 'Name') ]);
            }

            foreach ( config('excelColumns')[$sheet] as $column ) {


                $column = $column['excelColumnName'];
                $value = $rows[$i][ $this->getColumnNumber($sheet, $column) ];


                if( defineDbColumnType($sheet, $column) == 'integer' ){
                    $value = preg_replace('/[^0-9.]+/', '', $value);
                }
                if ($column == 'Position'){
                    $this->positions[] = $value;
                }

                $data[$i][$column] = $value;
            }
        }

        return $data;
    }

    public function uploadFile(Request $request)
    {
        $this->file = $request->file('attachedFile');
        $this->moveFile();
        $path = $this->filePath();

        $this->spreadsheet = IOFactory::load($path);

        $this->ifSheetsExist();

        foreach (array_keys(config('excelColumns')) as $sheet){
            $this->defineColumnsOrder($sheet);
        }

        $output = [];
        foreach (array_keys(config('excelColumns')) as $sheet){

            $output[$sheet] = $this->getData($sheet, $sheet == "Cites" ? true : false);

        }
        $this->writeCites($output);
        $this->writeSchools($output);
        $this->writePositions();

        $pr = new FillChartsInformation;
        $pr->writePositionRanks();

        return view('admin.layouts.upload-results', ['data'=> $output]);
    }





    public function writeCites($data){

        Cites::truncate();
        $citesColumns = $data['Cites'];
        unset($citesColumns[0]);
        foreach ($citesColumns as $row){
            $cites = new Cites();
            foreach ($row as $excelColumnName => $value){
                if($excelColumnName == 'shortlink'){
                    $dbColumnName = 'shortlink';
                } else {
                    $dbColumnName = defineDbColumnName('Cites', $excelColumnName);
                }

                $cites->{$dbColumnName} = $value;
            }
            $cites->save();
        }
    }

    public function writeSchools($data){

        Schools::truncate();
        $schoolsColumns = $data['Current Schools'];
        unset($schoolsColumns[0]);
        foreach ($schoolsColumns as $row){
            $schools = new Schools();
            foreach ($row as $excelColumnName => $value){

                $dbColumnName = defineDbColumnName('Current Schools', $excelColumnName);

                $schools->{$dbColumnName} = $value;
            }
            $schools->save();
        }
    }

    protected function writePositions(){
        Position::truncate();
        foreach(array_unique($this->positions) as $name){
            $position = new Position();
            $position->name = $name;
            $position->save();
        }
    }

}
