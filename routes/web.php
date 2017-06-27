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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::get('profile', 'HomeController@index')->name('profile');
Route::post('family-actions/{user}/set-father', 'FamilyActionsController@setFather')->name('family-actions.set-father');
Route::post('family-actions/{user}/set-mother', 'FamilyActionsController@setMother')->name('family-actions.set-mother');
Route::post('family-actions/{user}/add-child', 'FamilyActionsController@addChild')->name('family-actions.add-child');
Route::post('family-actions/{user}/add-wife', 'FamilyActionsController@addWife')->name('family-actions.add-wife');
Route::post('family-actions/{user}/add-husband', 'FamilyActionsController@addHusband')->name('family-actions.add-husband');

Route::get('users/{user}', 'UsersController@show')->name('users.show');
