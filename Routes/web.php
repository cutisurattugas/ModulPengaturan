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

use Illuminate\Support\Facades\Route;

Route::prefix('pengaturan')->group(function() {
    // Unit
    Route::prefix('unit')->group(function() {
        Route::get('/', 'UnitController@index')->name('unit.index');
        Route::post('/store', 'UnitController@store')->name('unit.store');
        Route::put('/update/{id}', 'UnitController@update')->name('unit.update');
        Route::delete('/destroy/{id}', 'UnitController@destroy')->name('unit.destroy');
    });
});
