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

Route::get('/', 'UsersController@search');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::get('profile', 'HomeController@index')->name('profile');
Route::post('family-actions/{user}/set-father', 'FamilyActionsController@setFather')->name('family-actions.set-father');
Route::post('family-actions/{user}/set-mother', 'FamilyActionsController@setMother')->name('family-actions.set-mother');
Route::post('family-actions/{user}/add-child', 'FamilyActionsController@addChild')->name('family-actions.add-child');
Route::post('family-actions/{user}/add-wife', 'FamilyActionsController@addWife')->name('family-actions.add-wife');
Route::post('family-actions/{user}/add-husband', 'FamilyActionsController@addHusband')->name('family-actions.add-husband');
Route::post('family-actions/{user}/set-parent', 'FamilyActionsController@setParent')->name('family-actions.set-parent');

Route::get('profile-search', 'UsersController@search')->name('users.search');
Route::get('users/{user}', 'UsersController@show')->name('users.show');
Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('users/{user}', 'UsersController@update')->name('users.update');
Route::get('users/{user}/chart', 'UsersController@chart')->name('users.chart');
Route::get('users/{user}/tree', 'UsersController@tree')->name('users.tree');

/**
 * Backup Restore Database Routes
 */
Route::post('backups/upload', ['as'=>'backups.upload', 'uses'=>'BackupsController@upload']);
Route::post('backups/{fileName}/restore', ['as'=>'backups.restore', 'uses'=>'BackupsController@restore']);
Route::get('backups/{fileName}/dl', ['as'=>'backups.download', 'uses'=>'BackupsController@download']);
Route::resource('backups','BackupsController');