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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('anggota','AnggotaController');


Route::resource('kategori','KategoriController');


Route::resource('buku','BukuController');


Route::get('Kategori/edit/{id}', 'KategoriController@edit');


Route::get('Kategori/showBuku/{id}', 'KategoriController@showBuku');


Route::get('Kategori/getAnggota/{id}', 'KategoriController@getAnggota');


Route::post('/Kategori/update/{id}', 'KategoriController@update');
