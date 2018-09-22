<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * This class is used for "/admin/content" page
 *
 */
class ChangeContentController extends Controller
{

    public function showPage()
    {
        return view('admin.page-content');
    }


    public function updateContent(Request $request)
    {

        $this->updateData('year');
        $this->updateData('about');

        return redirect(route('admin.content'));
    }


    protected function updateData($type)
    {
        $data = Content::firstOrNew(array('type' => $type));
        $data->type = $type;
        $data->value = request()->{$type};
        $data->save();
    }
}
