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

// Route::get('/', function () {
//     return view('welcome',['title' => 'Belajar Laravel 7']);
// });

Route::get('/', function () {
    return redirect('home');
});
Route::get('home', function(){
    return view('home');
});


Route::get('edulevels', 'EdulevelController@data');
Route::get('edulevels/add', 'EdulevelController@add');
Route::post('edulevels', 'EdulevelController@addProcess');
Route::get('edulevels/edit/{id}', 'EdulevelController@edit');
Route::patch('edulevels/{id}', 'EdulevelController@editProcess');
Route::delete('edulevels/{id}', 'EdulevelController@delete');

Route::get('programs/trash', 'ProgramController@trash');
Route::get('programs/restore/{id?}', 'ProgramController@restore');
Route::get('programs/delete/{id?}', 'ProgramController@delete');
Route::get('programs/export', 'ProgramController@export');
Route::get('programs/import', 'ProgramController@import');
Route::post('programs/import', 'ProgramController@importProcess');
Route::resource('programs', 'ProgramController');