<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cites extends Model
{
    protected static $interestingPositions = [
        'Assistant Professor',
        'Associate Professor',
        'Professor'
    ];

    public static function employee($schoolName){
        $employees = self::where('current_school', $schoolName)->get();

        $personList = [];
        foreach ($employees as $employee){
            if (!in_array($employee->position, self::$interestingPositions)){
                continue;
            }
            $personList[] = [
                'id' => $employee->id,
//                'shortlink' => $employee->shortlink,
                'lastName' => $employee->last_name,
                'firstName' => $employee->first_name,
                'position' => $employee->position,
                'university' => $employee->current_school,
                'year' => $employee->year,
                'degreeSchool' => checkIfNA($employee->PhDSchool),
                'citationsFaculty' => checkIfNA($employee->cites_last_year_percent),
                'cites' => checkIfNA($employee->cites_last_year_count),
                'citationsRank' => checkIfNA($employee->rank_percent),
//                'h_index' => checkIfNA($employee->h_index),
                'citationsDepRank' => Schools::schoolRank($employee->current_school),
                'academicInterests' => checkIfNA($employee->interests),
//
//                'googleScholar' => $employee->link_googleScholar,
//                'researchGate' => $employee->link_researchGate,
//                'linkedIn' => $employee->link_linkedin,
//                'twitter' => $employee->link_twitter,
//                'website' => $employee->link_website
            ];
        }
        return $personList;
    }
}
