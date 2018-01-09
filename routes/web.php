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

  //Route::get('/db', 'AdminController@db')->name('admin.db');

  Route::get('/db/sports', 'AdminController@dbSports')->name('admin.db.sports');
  Route::post('/db/sports/update', 'AdminController@dbSportsUpdate')->name('admin.db.sportsupdate');

  Route::get('/db/categories', 'AdminController@dbCategories')->name('admin.db.categories');
  Route::post('/db/categories', 'AdminController@dbCategories')->name('admin.db.categories');
  Route::post('/db/categories/update', 'AdminController@dbCategoriesUpdate')->name('admin.db.categoriesupdate');

  Route::get('/db/tournaments', 'AdminController@dbTournaments')->name('admin.db.tournaments');
  Route::post('/db/tournaments', 'AdminController@dbTournaments')->name('admin.db.tournaments');
  Route::post('/db/tournaments/update', 'AdminController@dbTournamentsUpdate')->name('admin.db.tournamentsupdate');

  Route::get('/db/matches', 'AdminController@dbMatches')->name('admin.db.matches');
  Route::post('/db/matches', 'AdminController@dbMatches')->name('admin.db.matches');
  Route::post('/db/matches/update', 'AdminController@dbMatchesUpdate')->name('admin.db.matchesupdate');

  Route::get('/db', 'Db\DbController@index')->name('admin.db.index');

  Route::get('/db/books', 'Db\DbController@books')->name('admin.db.books');
  Route::post('/db/books', 'Db\DbController@books')->name('admin.db.books');
  Route::post('/db/books/update', 'Db\DbController@updatebooks')->name('admin.db.updatebooks');
});