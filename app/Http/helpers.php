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
        return ($i=='NA' || empty($i) || $i=='x') ? 'N/A' : $i;
    }

}

if (! function_exists('NAtoInteger')) {
    function NAtoInteger($sheet, $column, $value)
    {
        $integerElement = array_where(config('excelColumns')[$sheet], function ($value, $key) use ($column) {
            return $value['excelColumnName'] == $column && $value['type'] == 'integer';
        });
        if ( $integerElement ){
            $value = preg_replace("/[^0-9]/", '', $value);
            if (empty($value)) return 0;
        }
        return $value;
    }

}

if (! function_exists('setActive')) {
    function setActive($name)
    {
        return Route::currentRouteName() == $name ? ' class=active' :  '';
    }
}
