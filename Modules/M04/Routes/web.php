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

Route::prefix('m04')->group(function() {
    Route::get('/', 'M04Controller@index');

    // M04110	試題類別


    // M04120	建立試題
    Route::get('m04120', 'M04120Controller@index')->name('M04120');
    Route::get('m04120_tab1', 'M04120Controller@tab1')->name('m04120_tab1');
    Route::get('m04120_tab2', 'M04120Controller@tab2')->name('m04120_tab2');
    Route::get('m04120_tab2_view', 'M04120Controller@tab2_view')->name('m04120_tab2_view');


    // M04130	建立群組



    // M04140	建立題庫
    Route::get('m04140', 'M04140Controller@index')->name('m04140');
    Route::post('m04140', 'M04140Controller@index')->name('m04140');
    Route::get('m04140_view1/{status}/{id?}', 'M04140Controller@view1')->name('m04140_view1');
    Route::post('m04140_view1/{status}/{id?}', 'M04140Controller@view1')->name('m04140_view1');
    Route::get('m04140_view2/{status}/{id?}', 'M04140Controller@view2')->name('m04140_view2');
    Route::post('m04140_view2/{status}/{id?}', 'M04140Controller@view2')->name('m04140_view2');

    // M04150	發佈公告
    Route::get('m04150', 'M04150Controller@tab1')->name('m04150');
    Route::get('m04150_tab2', 'M04150Controller@tab2')->name('m04150_tab2');
    Route::get('m04150_tab3', 'M04150Controller@tab3')->name('m04150_tab3');
    Route::get('m04150_tab4', 'M04150Controller@tab4')->name('m04150_tab4');
    Route::get('m04150_tab1_view/{status}/{id?}', 'M04150Controller@tab1_view')->name('m04150_tab1_view');
    Route::get('m04150_tab31/{status}/{id?}', 'M04150Controller@tab31')->name('m04150_tab31');
    Route::get('m04150_tab32', 'M04150Controller@tab32')->name('m04150_tab32');
    Route::get('m04150_tab4_view/{status}/{id?}', 'M04150Controller@tab4_view')->name('m04150_tab4_view');

    // M04160	問卷設計


    // M04170	問卷填寫
    Route::get('m04170', 'M04170Controller@index')->name('m04170');
    Route::post('m04170', 'M04170Controller@index')->name('m04170');
    Route::get('m04170_view', 'M04170Controller@view')->name('m04170_view');
    Route::post('m04170_view', 'M04170Controller@view')->name('m04170_view');

    // M04180	統計報表
    Route::get('m04180', 'M04180Controller@index')->name('m04180');


});
