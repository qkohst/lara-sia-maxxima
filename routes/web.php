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

Route::get('/', 'SiswaController@index')->name('home');

Route::resource('/siswa', 'SiswaController',  [
    'names' => 'siswa',
    'uses' => ['index', 'store', 'show', 'update', 'destroy']
]);

Route::resource('/matpel', 'MataPelajaranController',  [
    'names' => 'matpel',
    'uses' => ['index', 'store', 'update', 'destroy']
]);
Route::resource('/ujian', 'UjianController',  [
    'names' => 'ujian',
    'uses' => ['index', 'store', 'destroy']
]);

Route::resource('/ujian/{id}/peserta', 'PesertaUjianController',  [
    'names' => 'peserta-ujian',
    'uses' => ['index', 'store', 'destroy']
]);
