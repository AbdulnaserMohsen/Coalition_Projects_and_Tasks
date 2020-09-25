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


Route::get('/', 'MainController@index')->name('index');
//projects
Route::get('/get_project/{id}', 'MainController@get_project')->name('get_project');
//tasks
Route::post('/add_task', 'MainController@add_task')->name('add_task');
Route::post('/edit_task/{id}', 'MainController@edit_task')->name('edit_task');
Route::get('/delete_task/{id}', 'MainController@delete_task')->name('delete_task');

Route::get('/set_priority/{numbers}', 'MainController@set_priority')->name('set_priority');