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

Route::prefix('e1')->group(function () {
    Route::get('/', 'E1Controller@index');

    // 照片批次上傳
    Route::get('A02220', 'AA02220Controller@index')->name('a02220');
    Route::post('A02220', 'A02220Controller@index')->name('a02220_post');
    Route::get('A02220/{status}/{id?}', 'A02220Controller@view')->name('a02220_view');
    Route::post('A02220/{status}/{id?}', 'A02220Controller@view_post')->name('a02220_view_post');

});
