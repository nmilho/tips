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

  Route::get('/db/dbsports', 'AdminController@dbSports')->name('admin.db.dbsports');
  Route::post('/db/dbsports', 'AdminController@dbSports')->name('admin.db.dbsports');
  Route::post('/db/dbsports/update', 'AdminController@dbSportsUpdate')->name('admin.db.dbsportsupdate');

  Route::get('/db/dbcategories', 'AdminController@dbCategories')->name('admin.db.dbcategories');
  Route::post('/db/dbcategories', 'AdminController@dbCategories')->name('admin.db.dbcategories');
  Route::post('/db/dbcategories/update', 'AdminController@dbCategoriesUpdate')->name('admin.db.dbcategoriesupdate');

  Route::get('/db/dbtournaments', 'AdminController@dbTournaments')->name('admin.db.dbtournaments');
  Route::post('/db/dbtournaments', 'AdminController@dbTournaments')->name('admin.db.dbtournaments');
  Route::post('/db/dbtournaments/update', 'AdminController@dbTournamentsUpdate')->name('admin.db.dbtournamentsupdate');

  Route::get('/db/dbmatches', 'AdminController@dbMatches')->name('admin.db.dbmatches');
  Route::post('/db/dbmatches', 'AdminController@dbMatches')->name('admin.db.dbmatches');
  Route::post('/db/dbmatches/update', 'AdminController@dbMatchesUpdate')->name('admin.db.dbmatchesupdate');

  Route::get('/db', 'Db\DbController@index')->name('admin.db.index');

  Route::get('/db/books', 'Db\DbController@books')->name('admin.db.books');
  //Route::post('/db/books', 'Db\DbController@books')->name('admin.db.books');
  Route::post('/db/books/update', 'Db\DbController@updatebooks')->name('admin.db.updatebooks');
  Route::post('/db/books/delete', 'Db\DbController@deletebooks')->name('admin.db.deletebooks');

  Route::get('/db/sports', 'Db\DbController@sports')->name('admin.db.sports');
  //Route::post('/db/sports', 'Db\DbController@sports')->name('admin.db.sports');
  Route::post('/db/sports/update', 'Db\DbController@updatesports')->name('admin.db.updatesports');
  Route::post('/db/sports/delete', 'Db\DbController@deletesports')->name('admin.db.deletesports');

  Route::get('/db/categories', 'Db\DbController@categories')->name('admin.db.categories');
  //Route::post('/db/categories', 'Db\DbController@categories')->name('admin.db.categories');
  Route::post('/db/categories/update', 'Db\DbController@updatecategories')->name('admin.db.updatecategories');
  Route::post('/db/categories/delete', 'Db\DbController@deletecategories')->name('admin.db.deletecategories');

  Route::get('/db/tournaments', 'Db\DbController@tournaments')->name('admin.db.tournaments');
  //Route::post('/db/seasons', 'Db\DbController@seasons')->name('admin.db.seasons');
  Route::post('/db/tournaments/update', 'Db\DbController@updatetournaments')->name('admin.db.updatetournaments');
  Route::post('/db/tournaments/delete', 'Db\DbController@deletetournaments')->name('admin.db.deletetournaments');

  Route::get('/db/test', 'Db\DbController@test')->name('admin.db.test');

});