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
Auth::routes(['register' => false]);
Route::get('Login', 'Auth\LoginController@authenticate')->name('Login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', function(Request $request){
  return redirect()->route('home');
})->name('/');


Route::get('home', 'webController@index')->name('home');
Route::post('addTask', 'webController@addTask')->name('addTask');


Auth::routes();


