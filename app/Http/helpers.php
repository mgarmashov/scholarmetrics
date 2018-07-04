<?php

if (! function_exists('defineDbColumnName')) {
    function defineDbColumnName($sheet, $excelColumnName)
    {
        foreach (config('excelColumns')[$sheet] as $element){
            if($element['excelColumnName']==$excelColumnName){
                return $element['dbColumnName'];
            }
        }
        return null;
    }
}

if (! function_exists('defineDbColumnType')) {
    function defineDbColumnType($sheet, $excelColumnName)
    {
        foreach (config('excelColumns')[$sheet] as $element){
            if($element['excelColumnName']==$excelColumnName){
                return $element['type'];
            }
        }
        return null;
    }
}