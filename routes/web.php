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


Route::group(['prefix'=>'admin','as'=>'admin.', 'middleware'=>'auth'], function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');
    Route::get('/upload', 'Admin\UploadExcelController@showPage')->name('uploadExcelPage');

    Route::post('/uploadFile', 'Admin\UploadExcelController@uploadFile')->name('uploadFile');
});

Auth::routes();


