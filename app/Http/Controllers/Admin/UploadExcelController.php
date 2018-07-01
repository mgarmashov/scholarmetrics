<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

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
            if( !in_array($column, $rows[0] )){
                abort (response()->json( ['error' => 500, 'message' => "Can't find column '$column' in sheet '$sheet'. Names of columns should be placed at first row." ], 500));
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

        for($i = 0; $i < count($rows); $i++){
            if(empty($rows[$i][$this->getColumnNumber($sheet, 'Name')]) && empty($rows[$i][$this->getColumnNumber($sheet, 'Planning School')])){
                continue;
            }
            if ($shortlink){
                $data[$i]['shortlink'] = preg_replace("/[^a-zA-Z0-9]+/", "",$rows[$i][ $this->getColumnNumber($sheet, 'Name') ]);
            }

            foreach ( config('excelColumns')[$sheet] as $column ) {
                $data[$i][$column] = $rows[$i][ $this->getColumnNumber($sheet, $column) ];
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
            if ($sheet == "Cites"){
                $output[$sheet] = $this->getData($sheet, true);
            } else {
                $output[$sheet] = $this->getData($sheet);
            }
        }
//dd($output);
        return view('admin.layouts.upload-results', ['data'=> $output]);
    }

    public function showPage(){
        return view('admin.page-upload-excel');
    }
}
