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

Route::prefix('m02')->group(function () {
    Route::get('/', 'M02Controller@index');

    Route::get('m02110', 'M02110Controller@index')->name('m02110');
    Route::post('m02110', 'M02110Controller@index')->name('m02110');

    Route::get('m02110_view/{status}/{id?}', 'M02110Controller@view')->name('m02110_view');
    Route::post('m02110_view/{status}/{id?}', 'M02110Controller@save')->name('m02110_view');

    Route::get('m02110_view_tab2/{status}/{id?}', 'M02110Controller@view_tab2')->name('m02110_view_tab2');
    Route::post('m02110_view_tab2/{status}/{id?}', 'M02110Controller@save')->name('m02110_view_tab2');

    Route::get('m02110_view_tab3/{status}/{id?}', 'M02110Controller@view_tab3')->name('m02110_view_tab3');
    Route::post('m02110_view_tab3/{status}/{id?}', 'M02110Controller@save')->name('m02110_view_tab3');

    // Route::get('m02110_view_top/{id?}', 'M02110Controller@view_top')->name('m02110_view_top');
    // Route::post('m02110_view_top/{id?}', 'M02110Controller@save')->name('m02110_view_top');

    //M02120 修改密碼
    Route::get('m02120', 'M02120Controller@index')->name('m02120');
    Route::post('m02120', 'M02120Controller@index')->name('m02120');
    Route::get('m02120_view/{status}/{id?}', 'M02120Controller@view')->name('m02120_view');
    Route::post('m02120_view/{status}/{id?}', 'M02120Controller@save')->name('m02120_view');

    //M02130 密碼還原預設
    Route::get('m02130', 'M02130Controller@index')->name('m02130');
    Route::post('m02130', 'M02130Controller@index')->name('m02130');

    Route::get('m02130_tab2', 'M02130Controller@tab2')->name('m02130_tab2');
    Route::post('m02130_tab2', 'M02130Controller@tab2')->name('m02130_tab2');

    Route::get('m02130_tab2_view/{id?}', 'M02130Controller@tab2_view')->name('m02130_tab2_view');
    Route::post('m02130_tab2_view/{id?}', 'M02130Controller@save')->name('m02130_tab2_view');

    //M02140登入紀錄
    Route::get('m02140', 'M02140Controller@index')->name('m02140');
    Route::post('m02140', 'M02140Controller@index')->name('m02140');

    //M02150 列印相關報表
    Route::get('m02150', 'M02150Controller@index')->name('m02150');
    Route::post('m02150', 'M02150Controller@index')->name('m02150');

    Route::get('m02150/Stda2', 'M02150Controller@Stda2')->name('m02150_Stda2');
    Route::post('m02150/Stda2', 'M02150Controller@Stda2');

    Route::get('m02150/Stda', 'M02150Controller@Stda')->name('m02150_Stda');
    Route::post('m02150/Stda', 'M02150Controller@Stda');

    Route::get('m02150/Stda3', 'M02150Controller@Stda3')->name('m02150_Stda3');
    Route::post('m02150/Stda3', 'M02150Controller@Stda3');

});
