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

Route::prefix('c3')->group(function () {
    Route::get('/', 'C3Controller@index');
    // C03110建立問卷時間
    Route::get('c03110', 'C03110Controller@index')->name('c03110');
    Route::post('c03110', 'C03110Controller@index')->name('c03110_post');

    Route::get('c03110/add', 'C03110Controller@add')->name('c03110_add');
    Route::post('c03110/add', 'C03110Controller@add')->name('c03110_add_post');

    Route::get('c03110/view', 'C03110Controller@view')->name('c03110_view');
    Route::post('c03110/view', 'C03110Controller@view')->name('c03110_view_post');

    Route::get('c03110/edit', 'C03110Controller@edit')->name('c03110_edit');
    Route::post('c03110/edit', 'C03110Controller@edit')->name('c03110_edit_post');

    // C03120建立及維護題庫
    Route::get('c03120', 'C03120Controller@index')->name('c03120');
    Route::post('c03120', 'C03120Controller@index')->name('c03120_post');

    Route::get('c03120/add', 'C03120Controller@add')->name('c03120_add');
    Route::post('c03120/add', 'C03120Controller@add')->name('c03120_add_post');
    Route::get('c03120/add_jump', 'C03120Controller@add_jump')->name('c03120_add_jump');
    Route::post('c03120/add_jump', 'C03120Controller@add_jump')->name('c03120_add_jump_post');

    Route::get('c03120/view', 'C03120Controller@view')->name('c03120_view');
    Route::post('c03120/view', 'C03120Controller@view')->name('c03120_view_post');

    Route::get('c03120/edit', 'C03120Controller@edit')->name('c03120_edit');
    Route::post('c03120/edit', 'C03120Controller@edit')->name('c03120_edit_post');
    Route::get('c03120/edit_edit', 'C03120Controller@edit_edit')->name('c03120_edit_edit');
    Route::post('c03120/edit_edit', 'C03120Controller@edit_edit')->name('c03120_edit_edit_post');
    Route::get('c03120/edit_edit_jump', 'C03120Controller@edit_edit_jump')->name('c03120_edit_edit_jump');
    Route::post('c03120/edit_edit_jump', 'C03120Controller@edit_edit_jump')->name('c03120_edit_edit_jump_post');
    Route::get('c03120/edit_edit_edit', 'C03120Controller@edit_edit_edit')->name('c03120_edit_edit_edit');
    Route::post('c03120/edit_edit_edit', 'C03120Controller@edit_edit_edit')->name('c03120_edit_edit_edit_post');

    // C03210設定問卷
    Route::get('c03210', 'C03210Controller@index')->name('c03210');
    Route::post('c03210', 'C03210Controller@index')->name('c03210_post');

    Route::get('c03210/add', 'C03210Controller@add')->name('c03210_add');
    Route::post('c03210/add', 'C03210Controller@add')->name('c03210_add_post');
    Route::get('c03210/add_jump', 'C03210Controller@add_jump')->name('c03210_add_jump');
    Route::post('c03210/add_jump', 'C03210Controller@add_jump')->name('c03210_add_jump_post');

    Route::get('c03210/view', 'C03210Controller@view')->name('c03210_view');
    Route::post('c03210/view', 'C03210Controller@view')->name('c03210_view_post');

    Route::get('c03210/edit', 'C03210Controller@edit')->name('c03210_edit');
    Route::post('c03210/edit', 'C03210Controller@edit')->name('c03210_edit_post');

    Route::get('c03210/import', 'C03210Controller@import')->name('c03210_import');
    Route::post('c03210/import', 'C03210Controller@import')->name('c03210_import_post');

    // C03220學生填寫問卷
    Route::get('c03220', 'C03220Controller@index')->name('c03220');
    Route::post('c03220', 'C03220Controller@index')->name('c03220_post');

    Route::get('c03220/fill', 'C03220Controller@fill')->name('c03220_fill');
    Route::post('c03220/fill', 'C03220Controller@fill')->name('c03220_fill_post');

    Route::get('c03220/view', 'C03220Controller@view')->name('c03220_view');
    Route::post('c03220/view', 'C03220Controller@view')->name('c03220_view_post');

    // C03230匯入學生填答資料
    Route::get('c03230', 'C03230Controller@index')->name('c03230');
    Route::post('c03230', 'C03230Controller@index')->name('c03230_post');

    Route::get('c03230/import', 'C03230Controller@import')->name('c03230_import');
    Route::post('c03230/import', 'C03230Controller@import')->name('c03230_import_post');

    // C03240查詢問卷:承辦人, 系助教, 班級導師
    Route::get('c03240', 'C03240Controller@index')->name('c03240');
    Route::post('c03240', 'C03240Controller@index')->name('c03240_post');

    Route::get('c03240/view_tab1', 'C03240Controller@view_tab1')->name('c03240_view_tab1');
    Route::post('c03240/view_tab1', 'C03240Controller@view_tab1')->name('c03240_view_tab1_post');

    Route::get('c03240/view_tab2', 'C03240Controller@view_tab2')->name('c03240_view_tab2');
    Route::post('c03240/view_tab2', 'C03240Controller@view_tab2')->name('c03240_view_tab2_post');

    Route::get('c03240/tab2', 'C03240Controller@tab2')->name('c03240_tab2');
    Route::post('c03240/tab2', 'C03240Controller@tab2')->name('c03240_tab2_post');

    Route::get('c03240/tab2_view_tab1', 'C03240Controller@tab2_view_tab1')->name('c03240_tab2_view_tab1');
    Route::post('c03240/tab2_view_tab1', 'C03240Controller@tab2_view_tab1')->name('c03240_tab2_view_tab1_post');

    Route::get('c03240/tab2_view_tab2', 'C03240Controller@tab2_view_tab2')->name('c03240_tab2_view_tab2');
    Route::post('c03240/tab2_view_tab2', 'C03240Controller@tab2_view_tab2')->name('c03240_tab2_view_tab2_post');

    // C03240查詢問卷:學生
    Route::get('c03240/std', 'C03240Controller@index_std')->name('c03240_index_std');
    Route::post('c03240/std', 'C03240Controller@index_std')->name('c03240_index_std_post');

    Route::get('c03240/std_view', 'C03240Controller@index_std_view')->name('c03240_index_std_view');
    Route::post('c03240/std_view', 'C03240Controller@index_std_view')->name('c03240_index_std_view_post');

    // C03250列印清冊
    Route::get('c03250', 'C03250Controller@index')->name('c03250');
    Route::get('c03250/jump1', 'C03250Controller@jump1')->name('c03250_jump1');
    Route::get('c03250/jump2/{id}', 'C03250Controller@jump2')->name('c03250_jump2');
    Route::post('c03250/jump2/{id}', 'C03250Controller@event');
    Route::get('c03250/jump3', 'C03250Controller@jump3')->name('c03250_jump3');
    Route::get('c03250/jump4', 'C03250Controller@jump4')->name('c03250_jump4');
    Route::get('c03250/jump5', 'C03250Controller@jump5')->name('c03250_jump5');

});
