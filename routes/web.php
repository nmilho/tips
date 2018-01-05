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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::prefix('admin')->group(function() {
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  
  Route::get('/sports', 'AdminController@sports')->name('admin.sports');
  Route::post('/sports/update', 'AdminController@sportsupdate')->name('admin.sportsupdate');

  
  Route::get('/categories', 'AdminController@categories')->name('admin.categories');
  Route::post('/categories', 'AdminController@categories')->name('admin.categories');
  Route::post('/categories/update', 'AdminController@categoriesupdate')->name('admin.categoriesupdate');

  Route::get('/tournaments', 'AdminController@tournaments')->name('admin.tournaments');
  Route::post('/tournaments', 'AdminController@tournaments')->name('admin.tournaments');
  Route::post('/tournaments/update', 'AdminController@tournamentsupdate')->name('admin.tournamentsupdate');

  Route::get('/matches/update', 'AdminController@matchesupdate')->name('admin.matchesupdate');
  Route::post('/matches/update', 'AdminController@matchesupdate')->name('admin.matchesupdate');  
});