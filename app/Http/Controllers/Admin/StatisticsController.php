<?php

namespace App\Http\Controllers\Admin;

use App\Models\History;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


/**
 * This class is used for "/admin/statistics" page
 *
 */
class StatisticsController extends Controller
{

    protected $aliases = ['byLink', '#personTab', '#departmentTab'];
    protected $tops = [];

    public function showPage()
    {

        $count = count(History::all());

        $data = History::orderBy('id', 'desc')->paginate(15);

        foreach ($data as $row) {
            switch ($row->type) {
                case 'byLink':
                    $row->type = '<b>Person</b> is opened by link';
                    $row->tdClass = 'byLink';
                    break;
                case '#personTab':
                    $row->type = '<b>Person</b> is opened';
                    $row->tdClass = 'personIsOpened';
                    break;
                case 'search_#personTab':
                    $row->type = 'Text is searched <b>(Person)</b>';
                    $row->tdClass = 'personIsSearched';
                    break;
                case '#departmentTab':
                    $row->type = '<b>Department</b> is opened';
                    $row->tdClass = 'deptIsOpened';
                    break;
                case 'search_#departmentTab':
                    $row->type = 'Text is searched <b>(Department)</b>';
                    $row->tdClass = 'deptIsSearched';
                    break;
                default:
                    $row->type = '';
                    $row->tdClass = '';
                    break;
            }
        }

        $this->getTops();

        return view('admin.page-statistics', ['count' => $count, 'data' => $data, 'tops' => $this->tops]);

    }


    public function getTops()
    {

        $today = Carbon::today();

        foreach ($this->aliases as $alias) {
            $history = new History;
            $rows = $history->where('created_at', '>', $today->subDays(90))->where('type', $alias)->get();

            $names = $this->getNamesInRows($rows);

            $total = $this->countTotalUsingOfNames($names, $rows);

            $this->tops = array_add($this->tops, $alias, $total);
        }

    }


    protected function getNamesInRows($rows)
    {
        $names = [];
        foreach ($rows as $row) {
            $names[] = $row->name;
        }
        return array_unique($names);
    }


    protected function countTotalUsingOfNames($names, $rows, $limit = 5)
    {
        $output = [];

        foreach ($names as $name) {
            $output[] = ['name' => $name, 'total' => count($rows->where('name', $name))];
        }

        $output = array_values(array_sort($output, function ($value) {
            return $value['total'];
        }));

        $output = array_reverse($output);
        $output = array_slice($output, 0, $limit);

        return $output;
    }
}
