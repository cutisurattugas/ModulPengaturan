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
    // Golongan
    Route::prefix('golongan')->group(function() {
        Route::get('/', 'GolonganController@index')->name('golongan.index');
        Route::post('/store', 'GolonganController@store')->name('golongan.store');
        Route::put('/update/{id}', 'GolonganController@update')->name('golongan.update');
        Route::delete('/destroy/{id}', 'GolonganController@destroy')->name('golongan.destroy');
    });
    // jabatan
    Route::prefix('jabatan')->group(function() {
        Route::get('/', 'JabatanController@index')->name('jabatan.index');
        Route::post('/store', 'JabatanController@store')->name('jabatan.store');
        Route::put('/update/{id}', 'JabatanController@update')->name('jabatan.update');
        Route::delete('/destroy/{id}', 'JabatanController@destroy')->name('jabatan.destroy');
    });
    // Pegawai
    Route::prefix('pegawai')->group(function() {
        Route::get('/', 'PegawaiController@index')->name('pegawai.index');
        Route::post('/store', 'PegawaiController@store')->name('pegawai.store');
        Route::put('/update/{id}', 'PegawaiController@update')->name('pegawai.update');
        Route::delete('/destroy/{id}', 'PegawaiController@destroy')->name('pegawai.destroy');
    });
    // Pejabat
    Route::prefix('pejabat')->group(function() {
        Route::get('/', 'PejabatController@index')->name('pejabat.index');
        Route::post('/store', 'PejabatController@store')->name('pejabat.store');
        Route::put('/update/{id}', 'PejabatController@update')->name('pejabat.update');
        Route::delete('/destroy/{id}', 'PejabatController@destroy')->name('pejabat.destroy');
    });
});
