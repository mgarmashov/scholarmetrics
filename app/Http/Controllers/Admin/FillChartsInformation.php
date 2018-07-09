<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cites;
use App\Models\Position;
use App\Models\PositionsRank;
use Illuminate\Http\Request;

class FillChartsInformation extends Controller
{

    protected $list = [];
    protected $positions;

    public function writePositionRanks(){
        $this->positions = Position::pluck('name');

        PositionsRank::truncate();
        $this->writeCurrentPositionRanks();

        $this->list = [];
        $this->writeAllPositionsRanks();

    }

    public function writeCurrentPositionRanks()
    {
        foreach ($this->positions as $position){
            $cites = Cites::where('position', $position)->get();

            if (empty($cites) || $position == 'all_positions' || $position == 'Position'){
                continue;
            }

            foreach ($cites as $person){
                $this->takeMaxValueForCurrentPercent($person);
            }

            $this->fillEmptyPercents();


            ksort($this->list);
//            dd($position);
//            dd(Position::where('name',$position)->first());
            foreach ($this->list as $percent => $score){
                $positionRank = new PositionsRank;

                $positionRank->percent = $percent;
                $positionRank->higher_num = $score;
                $positionRank->position_id = Position::where('name',$position)->first()->id;
                $positionRank->position_name = $position;

                $positionRank->save();
            }

        }
    }

    public function writeAllPositionsRanks()
    {
//        $positions = array_values($positions);
//        foreach ($positions as $position){
        $cites = Cites::all();

        foreach ($cites as $person){
            $this->takeMaxValueForCurrentPercent($person, true);
        }
//        foreach ($cites as $person){
//            if(!isset($person->cites_last_year_percent) || !isset($person->cites_last_year_count)){
//                continue;
//            }
//            if (!isset($list[$person->cites_last_year_percent]) || $person->cites_last_year_count > $list[$person->cites_last_year_percent]) {
//                $list[$person->cites_last_year_percent] = $person->cites_last_year_count;
//            }
//        }

        $this->fillEmptyPercents();
//        for($i=0;$i<=100;$i++){
//
//            if (!array_key_exists($i, $list)) {
//                $list[$i] = $list[($i-1)];
////                if(isset($list[($i-1)])){
////                    $list[$i] = $list[($i-1)];
////                } else {$list[$i] = 0;}
//            }
//        }

        ksort($this->list);
        foreach ($this->list as $percent => $score){
            $positionRank = new PositionsRank;

            $positionRank->percent = $percent;
            $positionRank->higher_num = $score;
            $positionRank->position_id = Position::where('name','all_positions')->first()->id;
            $positionRank->position_name = 'all_positions';

            $positionRank->save();
        }


    }


    protected function takeMaxValueForCurrentPercent($person, $isAllPositions = false){
        $count = $person->cites_last_year_count;
        $currentPercent = $isAllPositions ? $person->cites_last_year_percent :$person->rank_percent;

        if (empty($this->list[$currentPercent]) || $count > $this->list[$currentPercent]) {
            $this->list[$currentPercent] = $count;
        }
    }

    protected function fillEmptyPercents(){
        for($percent=1; $percent<=100; $percent++){
            if (isset ($this->list[$percent])){
                continue;
            }
//            $previousElement = $this->list[($percent-1)] ?? null;

            $this->list[$percent] = $this->list[($percent-1)] ?? 0;
//            if( isset($previousElement) ){
//                $this->list[$percent] = $previousElement;
//            } else {
//                $this->list[$percent] = 0;
//            }
        }
    }
//    }

}
