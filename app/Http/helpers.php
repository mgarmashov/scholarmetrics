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


if (! function_exists('checkIfNA')) {
    function checkIfNA($i)
    {
        return ($i=='NA' || empty($i)) ? 'N/A' : $i;
    }

}

if (! function_exists('setActive')) {
    function setActive($name)
    {
        return Route::currentRouteName() == $name ? ' class=active' :  '';
    }
}
