<?php
//元件-Library
Route::group(array('prefix' => 'system', 'namespace' => 'Module\System'), function () {
    // 首頁區
    Route::get('home', 'HomeController@index')->name('s01000');

    // 公佈欄管理
    Route::get('board_mgmt', 'BoardMgmtController@index')->name('s01001');

    // 公佈欄管理（登入頁）
    Route::get('Login_board_mgmt', 'LoginBoardMgmtController@index')->name('s01002');

    // 系統參數管理
    Route::get('param_mgmt', 'ParamMgmtController@index')->name('s01100');

    // 功能選單管理
    Route::get('menu_mgmt', 'MenuMgmtController@index')->name('s01101');

    // 系統帳戶管理
    Route::get('account_mgmt', 'AccountMgmtController@index')->name('s01200');

    // 帳戶群組管理
    Route::get('account_group_mgmt', 'AccountGroupMgmtController@index')->name('s01201');
});

/*Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
 */
//公佈欄管理
