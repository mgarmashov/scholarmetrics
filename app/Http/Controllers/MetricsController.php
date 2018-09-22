<?php

namespace App\Http\Controllers;

use App\Models\PositionsRank;
use App\Models\Schools;
use Illuminate\Http\Request;
use App\Models\Cites;

/**
 * This class is used for showing data in Metrics page. It's called by ajax.
 *
 */
class MetricsController extends Controller
{
    protected $cites;
    protected $textValue;
    protected $responseData;

    public function getList(Request $request)
    {
        $searchType = $request->searchType;
        $this->textValue = $request->textValue;

        if (!empty($request->shortlink)) {
            $this->cites = $this->getPersonData();
            $this->responseData = $this->getPersonsInfo();

        } elseif ($searchType == 'person') {
            $this->cites = $this->getCitesData();
            $this->responseData = $this->getPersonsInfo();

        } else {
            $this->responseData = $this->getSchoolsInfo();
        }

        return response()->json($this->responseData);
    }


    protected function getCitesData()
    {
        $model = new Cites;
        return $model->where('last_name', 'like', '%' . $this->textValue . '%')->get();
    }


    protected function getPersonsInfo()
    {

        $personList = [];
        $chosenPersonsPosts[] = 'all_positions';

        foreach ($this->cites as $row) {
            $personList[] = [
                'id' => $row->id,
                'shortlink' => $row->shortlink,
                'lastName' => $row->last_name,
                'firstName' => $row->first_name,
                'position' => $row->position,
                'university' => $row->current_school,
                'year' => $row->year,
                'degreeSchool' => checkIfNA($row->PhDSchool),
                'citationsFaculty' => checkIfNA($row->cites_last_year_percent),
                'total' => checkIfNA($row->cites_last_year_count),
                'citationsRank' => checkIfNA($row->rank_percent),
                'h_index' => checkIfNA($row->h_index),
                'citationsDepRank' => Schools::schoolRank($row->current_school),
                'academicInterests' => checkIfNA($row->interests),

                'googleScholar' => $row->link_googleScholar,
                'researchGate' => $row->link_researchGate,
                'linkedIn' => $row->link_linkedin,
                'twitter' => $row->link_twitter,
                'website' => $row->link_website
            ];
            $chosenPersonsPosts[] = $row->position;
        }

        $chartsData = $this->getChartNumbers(array_unique($chosenPersonsPosts));

        return [
            'persons' => $personList,
            'chartStat' => $chartsData
        ];
    }

    protected function getChartNumbers($chosenPersonsPosts)
    {
        $infoForCharts = array();
        foreach ($chosenPersonsPosts as $currentPost) {
            $positionRanks = PositionsRank::where('position_name', $currentPost)->get();
            foreach ($positionRanks as $positionRank) {
                $infoForCharts[$currentPost][$positionRank->percent] = intval($positionRank->higher_num);
            }

            if ($infoForCharts[$currentPost]) {
                ksort($infoForCharts[$currentPost]);
            }

        }

        return $infoForCharts;
    }

    protected function getSchoolsInfo()
    {

        $schools = new Schools;
        $results = $schools->where('name', 'like', '%' . $this->textValue . '%')->get();

        $schoolsList = [];
        $chosenPersonsPosts[0] = 'all_positions';

        foreach ($results as $row) {
            $schoolsList[] = [
                'id' => $row->id,
                'rank' => checkIfNA($row->rank),
                'website' => $row->url,
                'name' => $row->name,
                'employee' => Cites::employee($row->name)
            ];
        }

        return $schoolsList;
    }
}
