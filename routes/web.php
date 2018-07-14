<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/metrics', function () {
    return view('metrics');
})->name('metrics');


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/send/contact', 'EmailController@sendContactEmail')->name('sendContactEmail');
//Route::any('/send/{type?}', 'EmailController_old@init')->name('sendEmail');

Route::get('/person', function(){return redirect(route('metrics'));});

Route::group(['prefix'=>'admin','as'=>'admin.', 'middleware'=>'auth'], function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');
    Route::get('/upload', 'Admin\UploadExcelController@showPage')->name('uploadExcelPage');
    Route::get('/data/{sheet?}', 'Admin\DataController@showPage')->name('data');
    Route::post('/uploadFile', 'Admin\UploadExcelController@uploadFile')->name('uploadFile');

    Route::get('/statistics', 'Admin\StatisticsController@showPage')->name('statistics');

    Route::get('/content', 'Admin\ChangeContentController@showPage')->name('content');
    Route::post('/content/update', 'Admin\ChangeContentController@updateContent')->name('post-content');
});

Auth::routes();



Route::get('/metrics/getList', 'MetricsController@getList')->name('ajax-getList');
Route::get('/saveHistory', 'HistoryWriteController@init')->name('ajax-saveHistory');



Route::get('/metrics/ajax-shortlink', 'PersonController@getList')->name('ajax-shortlink');

Route::get('/metrics/{shortlink}', 'NewPersonController@getList')->name('ajax-new-shortlink');

