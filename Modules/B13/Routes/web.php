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

Route::prefix('b13')->group(function () {
    Route::get('/', 'B13Controller@index');

    // B13110零分計算及通知
    Route::get('b13110', 'B13110Controller@index')->name('b13110');
    Route::post('b13110', 'B13110Controller@index');
    Route::get('b13110_view/{status}/{id?}', 'B13110Controller@view')->name('b13110_view');
    Route::post('b13110_view/{status}/{id?}', 'B13110Controller@save');
    Route::get('b13110_tab1', 'B13110Controller@tab1')->name('b13110_tab1');
    Route::post('b13110_tab1', 'B13110Controller@tab1');
    Route::get('b13110_tab1_view/{status}/{id?}', 'B13110Controller@tab1_view')->name('b13110_tab1_view');
    Route::post('b13110_tab1_view/{status}/{id?}', 'B13110Controller@save');
    Route::get('b13110_tab2', 'B13110Controller@tab2')->name('b13110_tab2');
    Route::post('b13110_tab2', 'B13110Controller@tab2');
    Route::get('b13110_tab2_view/{status}/{id?}', 'B13110Controller@tab2_view')->name('b13110_tab2_view');
    Route::post('b13110_tab2_view/{status}/{id?}', 'B13110Controller@save');

    // B13120 場地層級設定
    Route::get('b13120', 'B13120Controller@index')->name('b13120');
    Route::post('b13120', 'B13120Controller@index');
    Route::get('b13120_view/{status}/{id?}', 'B13120Controller@view')->name('b13120_view');
    Route::post('b13120_view/{status}/{id?}', 'B13120Controller@save');

    // B13130不開放時段設定
    Route::get('b13130', 'B13130Controller@index')->name('b13130');
    Route::post('b13130', 'B13130Controller@index');
    Route::get('b13130_view/{status}/{id?}', 'B13130Controller@view')->name('b13130_view');
    Route::post('b13130_view/{status}/{id?}', 'B13130Controller@save');
    Route::get('b13130_tab1', 'B13130Controller@tab1')->name('b13130_tab1');
    Route::post('b13130_tab1', 'B13130Controller@tab1');
    Route::get('b13130_tab1_view/{status}/{id?}', 'B13130Controller@tab1_view')->name('b13130_tab1_view');
    Route::post('b13130_tab1_view/{status}/{id?}', 'B13130Controller@save');

    // B13140輸入未開放說明
    Route::get('b13140', 'B13140Controller@index')->name('b13140');
    Route::post('b13140', 'B13140Controller@index');
    // B13150租借理由設定
    Route::get('b13150', 'B13150Controller@index')->name('b13150');
    Route::post('b13150', 'B13150Controller@index');

    // B13160申請場地借用
    Route::get('b13160', 'B13160Controller@index')->name('b13160');
    Route::post('b13160', 'B13160Controller@index');
    Route::get('b13160_view/{status}/{id?}', 'B13160Controller@view')->name('b13160_view');
    Route::post('b13160_view/{status}/{id?}', 'B13160Controller@save');
    Route::get('b13160_tab1', 'B13160Controller@tab1')->name('b13160_tab1');
    Route::post('b13160_tab1', 'B13160Controller@tab1');

    // B13210申請場地借用
    Route::get('b13210', 'B13210Controller@index')->name('b13210');
    Route::post('b13210', 'B13210Controller@index');
    Route::get('b13210_tab1', 'B13210Controller@tab1')->name('b13210_tab1');
    Route::post('b13210_tab1', 'B13210Controller@tab1');
    Route::get('b13210_tab2', 'B13210Controller@tab2')->name('b13210_tab2');
    Route::post('b13210_tab2', 'B13210Controller@tab2');
    // B13220借用審核
    Route::get('b13220', 'B13220Controller@index')->name('b13220');
    Route::post('b13220', 'B13220Controller@index');
    Route::get('b13220_view/{status}/{id?}', 'B13220Controller@view')->name('b13220_view');
    Route::post('b13220_view/{status}/{id?}', 'B13220Controller@save');
    Route::get('b13220_tab1', 'B13220Controller@tab1')->name('b13220_tab1');
    Route::post('b13220_tab1', 'B13220Controller@tab1');
    Route::get('b13220_tab1_view/{status}/{id?}', 'B13220Controller@tab1_view')->name('b13220_tab1_view');
    Route::post('b13220_tab1_view/{status}/{id?}', 'B13220Controller@save');
    Route::get('b13220_tab2', 'B13220Controller@tab2')->name('b13220_tab2');
    Route::post('b13220_tab2', 'B13220Controller@tab2');
    Route::get('b13220_tab3', 'B13220Controller@tab3')->name('b13220_tab3');
    Route::post('b13220_tab3', 'B13220Controller@tab3');
    Route::get('b13220_tab3_view/{status}/{id?}', 'B13220Controller@tab3_view')->name('b13220_tab3_view');
    Route::post('b13220_tab3_view/{status}/{id?}', 'B13220Controller@save');
    Route::get('b13220_tab4', 'B13220Controller@tab4')->name('b13220_tab4');
    Route::post('b13220_tab4', 'B13220Controller@tab4');

    // B13230申請場地借用
    Route::get('b13230', 'B13230Controller@index')->name('b13230');
    Route::post('b13230', 'B13230Controller@index');
    Route::get('b13230_tab2', 'B13230Controller@tab2')->name('b13230_tab2');
    Route::post('b13230_tab2', 'B13230Controller@tab2');

    // B13240申請場地借用
    Route::get('b13240', 'B13240Controller@index')->name('b13240');
    Route::post('b13240', 'B13240Controller@index');

});
