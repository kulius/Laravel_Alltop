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
Route::prefix('example')->group(function () {
    Route::get('/', 'ExampleController@index');

    //元件-Library
    Route::get('element', 'E00000Controller@index')->name('e00000');
    Route::get('element/form/jump_sgl', 'E00000Controller@jump_sgl')->name('e00000_jump_sgl');
    Route::get('element/form/jump_mul', 'E00000Controller@jump_mul')->name('e00000_jump_mul');
    Route::post('element/form/jump_sgl', 'E00000Controller@jump_sgl_handle')->name('e00000_jump_sgl');
    Route::post('element/form/jump_mul', 'E00000Controller@jump_mul_handle')->name('e00000_jump_mul');

    //單檔維護-Default
    Route::get('single', 'SingleController@index')->name('e00100');
    Route::post('single', 'SingleController@index');
    Route::get('single/{status}/{id?}', 'SingleController@view')->name('e00100_view');
    Route::post('single/{status}/{id?}', 'SingleController@save');

    Route::get('Jump/single', 'SingleController@jumpget')->name('e01000_jump');
    Route::post('Jump/single', 'SingleController@jumpget')->name('e01000_jump_post');

    //單檔維護-Grid
    Route::get('single_grid', 'SingleGridController@index')->name('e00101');

    //雙檔維護-Default
    Route::get('multi', 'MultiController@index')->name('e00200');
    Route::post('multi', 'MultiController@index');

    Route::get('multi_view1/{status}/{id?}', 'MultiController@view1')->name('e00200_view1');
    Route::post('multi_view1/{status}/{id?}', 'MultiController@view1_event')->name('e00200_view1_post');

    Route::get('multi_view2_index/{status}/{id?}', 'MultiController@view2_index')->name('multi_view2_index');
    Route::get('multi_view2/{status}/{id?}', 'MultiController@view2')->name('e00200_view2');
    Route::post('multi_view2/{status}/{id?}', 'MultiController@view2_event')->name('e00200_view2_post');

    //測試選單
    Route::get('test', 'E00301Controller@index')->name('e00301');

    // E00302 選擇請假日期起訖，產生日期節次勾選區塊
    Route::get('e00302', 'E00302Controller@index')->name('e00302');
    Route::post('e00302', 'E00302Controller@index');
    Route::get('e00302/{status}/{id?}', 'E00302Controller@view')->name('e00302_view');
    Route::post('e00302/{status}/{id?}', 'E00302Controller@event');
    // 學生資料彈跳視窗
    Route::get('e00302StuSel', 'E00302Controller@StuSel')->name('e00302_StuSel');
    Route::post('e00302StuSel', 'E00302Controller@StuSel');
    // 取得學生資料
    Route::post('getStuInfo', 'E00302Controller@getStuInfo')->name('e00302_getStuInfo');

    //E00303教師資料設定
    Route::get('e00303', 'E00303Controller@index')->name('e00303');
    Route::post('e00303', 'E00303Controller@index');
    Route::get('e00303/{status}/{id?}', 'E00303Controller@view')->name('e00303_view');
    Route::post('e00303/{status}/{id?}', 'E00303Controller@save');

    // 教育部代碼維護
    Route::get('A02150', 'A02150ControllerExample@index1')->name('e00304');
    Route::post('A02150', 'A02150ControllerExample@index1');
    Route::get('A02150/tab1/{status}/{id?}', 'A02150ControllerExample@view1')->name('e00304_view1');
    Route::post('A02150/tab1/{status}/{id?}', 'A02150ControllerExample@view1_post'); // 教育部代碼維護

    Route::get('A02150', 'A02150ControllerExample@index1')->name('e00304');
    Route::post('A02150', 'A02150ControllerExample@index1');
    Route::get('A02150/tab1/{status}/{id?}/asd=sad&asda=asa', 'A02150ControllerExample@view1')->name('e00304_view1');
    Route::post('A02150/tab1/{status}/{id?}', 'A02150ControllerExample@view1_post');

    Route::get('A02150/tab2', 'A02150ControllerExample@index2')->name('e00304_index2');
    Route::post('A02150/tab2', 'A02150ControllerExample@index2');
    Route::get('A02150/tab2/{status}/{id?}', 'A02150ControllerExample@view2')->name('e00304_view2');
    Route::post('A02150/tab2/{status}/{id?}', 'A02150ControllerExample@view2_post');

    // ajax 下拉瑞文測試用
    Route::get('e00305', 'AjaxComboController@index')->name('e00305');
    Route::post('e00305', 'AjaxComboController@index');
    Route::get('e00305/ClassTypeCombo', 'AjaxComboController@ClassTypeCombo')->name('e00305_ClassType');
});
