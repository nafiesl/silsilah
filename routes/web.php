<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\BackupsController;
use App\Http\Controllers\BirthdayController;
use App\Http\Controllers\CouplesController;
use App\Http\Controllers\FamilyActionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserMarriagesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [UsersController::class, 'search']);

    Route::controller(HomeController::class)->group(function () {
        Route::get('home', 'index')->name('home');
        Route::get('profile', 'index')->name('profile');
    });

    Route::controller(FamilyActionsController::class)->group(function () {
        Route::post('family-actions/{user}/set-father', 'setFather')->name('family-actions.set-father');
        Route::post('family-actions/{user}/set-mother', 'setMother')->name('family-actions.set-mother');
        Route::post('family-actions/{user}/add-child', 'addChild')->name('family-actions.add-child');
        Route::post('family-actions/{user}/add-wife', 'addWife')->name('family-actions.add-wife');
        Route::post('family-actions/{user}/add-husband', 'addHusband')->name('family-actions.add-husband');
        Route::post('family-actions/{user}/set-parent', 'setParent')->name('family-actions.set-parent');
    });

    Route::controller(UsersController::class)->group(function () {
        Route::get('profile-search', 'search')->name('users.search');
        Route::get('users/{user}', 'show')->name('users.show');
        Route::get('users/{user}/edit', 'edit')->name('users.edit');
        Route::patch('users/{user}', 'update')->name('users.update');
        Route::get('users/{user}/chart', 'chart')->name('users.chart');
        Route::get('users/{user}/tree', 'tree')->name('users.tree');
        Route::get('users/{user}/death', 'death')->name('users.death');
        Route::patch('users/{user}/photo-upload', 'photoUpload')->name('users.photo-upload');
        Route::delete('users/{user}', 'destroy')->name('users.destroy');
    });

    Route::get('users/{user}/marriages', [UserMarriagesController::class, 'index'])->name('users.marriages');

    Route::get('birthdays', [BirthdayController::class, 'index'])->name('birthdays.index');
    /**
     * Couple/Marriages Routes
     */
    Route::controller(CouplesController::class)->group(function () {
        Route::get('couples/{couple}', 'show')->name('couples.show');
        Route::get('couples/{couple}/edit', 'edit')->name('couples.edit');
        Route::patch('couples/{couple}', 'update')->name('couples.update');
    });

    Route::controller(ChangePasswordController::class)->group(function () {
        Route::get('password/change', 'show')->name('password_change');
        Route::post('password/change', 'update')->name('password_update');
    });
});

/**
 * Admin only routes
 */
Route::group(['middleware' => 'admin'], function () {
    /**
     * Backup Restore Database Routes
     */
    Route::controller(BackupsController::class)->group(function () {
        Route::post('backups/upload', 'upload')->name('backups.upload');
        Route::post('backups/{fileName}/restore', 'restore')->name('backups.restore');
        Route::get('backups/{fileName}/dl', 'download')->name('backups.download');
    });
    Route::resource('backups', BackupsController::class);
});
