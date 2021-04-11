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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/partenaire', 'PartenaireController@index');
Route::get('/show_partenaire/{id}', 'PartenaireController@show');
Route::get('/partenaire/{id}/{nom}/{bool}', 'PartenaireController@index');

Route::get('/update_partenaire_bool','PartenaireController@updatePartenaireBool');
Route::get('/update_grant_bool','PartenaireController@updateGrantBool');
