<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cites;
use App\Models\Position;
use App\Models\PositionsRank;
use Illuminate\Http\Request;

/**
 * This class is used during Uploading excel.
 * It's 2nd step. All data is placed to database.
 * And now we need to calculate numbers of statistic.
 * We place it in db. And later we will use them for drawing charts.
 *
 */
class FillChartsInformation extends Controller
{

    protected $list = [];
    protected $positions;

    public function writePositionRanks()
    {
        $this->positions = Position::pluck('name');

        PositionsRank::truncate();
        $this->writeCurrentPositionRanks();

        $this->list = [];
        $this->writeAllPositionsRanks();

    }

    public function writeCurrentPositionRanks()
    {
        foreach ($this->positions as $position) {
            $this->list = [];

            if ($position === 'all_positions' || $position === 'Position') {
                continue;
            }

            $cites = Cites::where('position', $position)->get();

            if (empty($cites)) {
                continue;
            }

            foreach ($cites as $person) {
                $this->takeMaxValueForCurrentPercent($person);
            }

            $this->fillEmptyPercents();


            ksort($this->list);

            //write 100 values for current positon in db
            foreach ($this->list as $percent => $score) {
                $positionRank = new PositionsRank;

                $positionRank->percent = $percent;
                $positionRank->higher_num = $score;
                $positionRank->position_id = Position::where('name', $position)->first()->id;
                $positionRank->position_name = $position;

                $positionRank->save();
            }

        }
    }

    public function writeAllPositionsRanks()
    {
        $cites = Cites::all();

        foreach ($cites as $person) {
            $this->takeMaxValueForCurrentPercent($person, true);
        }

        $this->fillEmptyPercents();

        ksort($this->list);

        //write 100 values for all positions in db
        foreach ($this->list as $percent => $score) {
            $positionRank = new PositionsRank;

            $positionRank->percent = $percent;
            $positionRank->higher_num = $score;
            $positionRank->position_id = Position::where('name', 'all_positions')->first()->id;
            $positionRank->position_name = 'all_positions';

            $positionRank->save();
        }


    }

    /**
     * If there is many values that equal the same percent, we use the largest value.
     *
     */
    protected function takeMaxValueForCurrentPercent($person, $isAllPositions = false)
    {
        $count = $person->cites_last_year_count;
        $currentPercent = $isAllPositions ? $person->cites_last_year_percent : $person->rank_percent;

        if (empty($this->list[$currentPercent]) || $count > $this->list[$currentPercent]) {
            $this->list[$currentPercent] = $count;
        }
    }

    /**
     * This class is used, because we need 100 points. Id we have less, chart will not be full.
     *
     */
    protected function fillEmptyPercents()
    {
        for ($percent = 1; $percent <= 100; $percent++) {
            if (isset ($this->list[$percent])) {
                continue;
            }
            $this->list[$percent] = $this->list[($percent - 1)] ?? 0;
        }
    }
}
