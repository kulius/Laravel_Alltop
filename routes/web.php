<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
 */
/* Route::get('/testing', function () {
return view('test');
}); */
Route::get('/bootTime', 'IndexController@bootTime');
Route::get('/testing', 'HomeController@ajax_button');
Route::post('/testing', 'HomeController@day_fg')->name('day');

//Jquery load 給彈跳視窗的初始路徑 -> 藉由傳遞參數 Iframe 會載入 $_GET['href']
Route::get('Jump/modal/default', 'HomeController@modal_default')->name('modal_default');

Route::get('/origin', 'IndexController@origin');
Route::get('/origin/ajax', 'IndexController@ajax')->name('ajax');

/* Route::get('/welcome', function () {
return view('welcome');
})->name('index'); */
Route::get('/welcome', 'IndexController@welcome')->name('index');

//登入頁
Route::get('/', 'IndexController@index');
Route::post('/', 'IndexController@login');

//首頁
Route::get('/clearSession', 'IndexController@clearSession')->name('clear');
Route::get('/home', 'HomeController@index')->name('home');

//功能導引
Route::get('/guide/{module}', 'GuideController@index');

// Donwload
Route::get('/download/{seq}', 'FileController@download')->name('download');

//系統管理
Route::prefix('s01')->group(function () {
    // 公佈欄管理
    Route::get('board_mgmt', 'BoardMgmtController@index')->name('s01001');

    // 公佈欄管理（登入頁）
    Route::get('Login_board_mgmt', 'LoginBoardMgmtController@index')->name('s01002');

    // 系統參數管理
    Route::get('s01100', 's01100Controller@index')->name('s01100');

    // 功能選單管理
    Route::get('s01101', 's01101Controller@index')->name('s01101');
    Route::post('s01101', 's01101Controller@index');
    Route::get('s01101/{status}/{view}/{id?}', 's01101Controller@view')->name('s01101_view');
    Route::post('s01101/{status}/{view}/{id?}', 's01101Controller@save');

    // 系統帳戶管理
    Route::get('s01200', 's01200Controller@index')->name('s01200');
    Route::post('s01200', 's01200Controller@index');
    Route::get('s01200/{status}/{id?}', 's01200Controller@view')->name('s01200_view');
    Route::post('s01200/{status}/{id?}', 's01200Controller@save');

    // 帳戶群組管理
    Route::get('s01201', 's01201Controller@index')->name('s01201');
    Route::post('s01201', 's01201Controller@index');
    Route::get('s01201/{status}/{id?}', 's01201Controller@view')->name('s01201_view');
    Route::post('s01201/{status}/{id?}', 's01201Controller@save');
});

// 線上表單簽核
Route::prefix('m06')->group(function () {
    // 虛擬單位設定
    Route::get('m06110', 'm06110Controller@index')->name('m06110');
    Route::post('m06110', 'm06110Controller@index');
    Route::get('m06110/{status}/{id?}', 'm06110Controller@view')->name('m06110_view');
    Route::post('m06110/{status}/{id?}', 'm06110Controller@save');

    // 簽核職稱維護
    Route::get('m06120', 'm06120Controller@index')->name('m06120');
    Route::post('m06120', 'm06120Controller@index');
    Route::get('m06120/{id}', 'm06120Controller@view')->name('m06120_view');
    Route::get('m06120/{id}/{status}/{id2?}', 'm06120Controller@view2')->name('m06120_view2');

    // 表單簽核關卡設定
    Route::get('m06130', 'm06130Controller@index')->name('m06130');
    Route::post('m06130', 'm06130Controller@index');
    Route::get('m06130/sign/{status}/{id?}', 'm06130Controller@view')->name('m06130_view');
    Route::post('m06130/sign/{status}/{id?}', 'm06130Controller@save');
    Route::get('m06130/sign/{status}/{id}/{grid_status}/{grid_id?}', 'm06130Controller@view_grid')->name('m06130_view_grid');
    Route::post('m06130/sign/{status}/{id}/{grid_status}/{grid_id?}', 'm06130Controller@save_grid');
    Route::get('m06130/custom/{status}/{id?}', 'm06130Controller@view_custom')->name('m06130_view_custom');
    Route::post('m06130/custom/{status}/{id?}', 'm06130Controller@save_custom');

    // 線上表單簽核
    Route::get('m06140', 'm06140Controller@index')->name('m06140');
    Route::post('m06140', 'm06140Controller@index');
    Route::get('m06140/{status}/{id?}', 'm06140Controller@view')->name('m06140_view');
    Route::post('m06140/{status}/{id?}', 'm06140Controller@save');

    // 代理人設定
    Route::get('m06150', 'm06150Controller@index')->name('m06150');
    Route::post('m06150', 'm06150Controller@index');
    Route::get('m06150/{status}/{id?}', 'm06150Controller@view')->name('m06150_view');
    Route::post('m06150/{status}/{id?}', 'm06150Controller@save');

    // 收件夾
    Route::get('m06160', 'm06160Controller@index')->name('m06160');
    Route::post('m06160', 'm06160Controller@index');
    Route::get('m06160/{status}/{id?}', 'm06160Controller@view')->name('m06160_view');
    Route::post('m06160/{status}/{id?}', 'm06160Controller@save');

    // 代理夾
    Route::get('m06170', 'm06170Controller@index')->name('m06170');
    Route::post('m06170', 'm06170Controller@index');
    Route::get('m06170/{status}/{id?}', 'm06170Controller@view')->name('m06170_view');
    Route::post('m06170/{status}/{id?}', 'm06170Controller@save');

    // 經手夾
    Route::get('m06180', 'm06180Controller@index')->name('m06180');
    Route::post('m06180', 'm06180Controller@index');
    Route::get('m06180/{status}/{id?}', 'm06180Controller@view')->name('m06180_view');
    Route::post('m06180/{status}/{id?}', 'm06180Controller@save');

    // 追蹤夾
    Route::get('m06190', 'm06190Controller@index')->name('m06190');
    Route::post('m06190', 'm06190Controller@index');
    Route::get('m06190/{status}/{id?}', 'm06190Controller@view')->name('m06190_view');
    Route::post('m06190/{status}/{id?}', 'm06190Controller@save');

    // 暫存夾
    Route::get('m061a0', 'm061a0Controller@index')->name('m061a0');
    Route::post('m061a0', 'm061a0Controller@index');
    Route::get('m061a0/{status}/{id?}', 'm061a0Controller@view')->name('m061a0_view');
    Route::post('m061a0/{status}/{id?}', 'm061a0Controller@save');

    // 退文夾
    Route::get('m061b0', 'm061b0Controller@index')->name('m061b0');
    Route::post('m061b0', 'm061b0Controller@index');
    Route::get('m061b0/{status}/{id?}', 'm061b0Controller@view')->name('m061b0_view');
    Route::post('m061b0/{status}/{id?}', 'm061b0Controller@save');

    // 歷史夾
    Route::get('m061c0', 'm061c0Controller@index')->name('m061c0');
    Route::post('m061c0', 'm061c0Controller@index');
    Route::get('m061c0/{status}/{id?}', 'm061c0Controller@view')->name('m061c0_view');
    Route::post('m061c0/{status}/{id?}', 'm061c0Controller@save');
});
