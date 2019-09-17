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

Route::prefix('m03')->group(function () {
    // 範本類別維護
    Route::get('m03110', 'm03110Controller@index')->name('m03110');
    Route::post('m03110', 'm03110Controller@save');

    // 公告範本管理
    Route::get('m03111', 'm03111Controller@index')->name('m03111');
    Route::post('m03111', 'm03111Controller@index');
    Route::get('m03111/{status}/{key?}', 'm03111Controller@view')->name('m03111_view');
    Route::post('m03111/{status}/{key?}', 'm03111Controller@save');

    // 公告或E-Mail發佈
    Route::get('m03120', 'm03120Controller@index')->name('m03120');
    Route::post('m03120', 'm03120Controller@index');
    Route::get('m03120/{status}/{key?}', 'm03120Controller@view')->name('m03120_view');
    Route::post('m03120/{status}/{key?}', 'm03120Controller@save');

    Route::get('m03120@jump', 'm03120Controller@index_jump')->name('m03120_jump');
    Route::post('m03120@jump', 'm03120Controller@index_jump');

    // 相關報表列印
    Route::get('m03130', 'm03130Controller@index')->name('m03130');
});
