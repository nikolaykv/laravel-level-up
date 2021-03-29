<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/admin/login', 'Auth\LoginController@showLoginForm');
Route::post('/admin/login', 'Auth\LoginController@login')->name('admin.login');

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'verified'], function () {
    Route::get('/home', 'HomeController@index')->middleware('is_student')->name('home');

    // Учебные группы
    Route::middleware(['is_admin'])->group(function () {
        Route::get('/admin', 'CRUD\Groups\GroupController@index')->name('groups.index');
        Route::resource('/groups', CRUD\Groups\GroupController::class);

        // Редиректы
        Route::redirect('/groups', '/admin');
    });
});
