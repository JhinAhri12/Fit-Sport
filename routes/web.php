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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/partenaire', 'PartenaireController@index');
Route::get('/show_partenaire', 'PartenaireController@show');
Route::get('/partenaire/{id}/{nom}/{bool}', 'PartenaireController@index');

Route::post('/create_structure','PartenaireController@create');

Route::get('/update_partenaire_bool','PartenaireController@updatePartenaireBool');
Route::get('/update_grant_bool','PartenaireController@updateGrantBool');
Route::get('/update_install_bool','PartenaireController@updateInstallBool');

Route::get('sendEmail','MailController@sendEmail');
Route::get('viewEmail','MailController@viewEmail');
