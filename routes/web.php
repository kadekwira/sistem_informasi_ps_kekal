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
    return redirect('login');
});

/** HALAMAN MULTI AKSES USER */
Route::middleware(['auth', 'ceklevel:admin,supporter'])->group(function () {
    /** pengurus*/
    Route::get('pengurus', 'PengurusController@index')->name('pengurus');
    Route::post('pengurus', 'PengurusController@insert')->name('pengurus');
    Route::post('pengurus/update', 'PengurusController@update')->name('pengurus.update');
    Route::get('pengurus/delete/{id}', 'PengurusController@delete');
    Route::get('pengurus/edit/{id}', 'PengurusController@edit');
});

Route::middleware(['auth', 'ceklevel:admin,supporter'])->group(function () {
    /** pemain*/
    Route::get('pemains', 'PemainController@index')->name('pemain');
    Route::post('pemains', 'PemainController@insert')->name('pemain');
    Route::post('pemains/update', 'PemainController@update')->name('pemain.update');
    Route::get('pemains/delete/{id}', 'PemainController@delete');
    Route::get('pemains/edit/{id}', 'PemainController@edit');
    /** inventaris*/
    Route::get('inventaris', 'InventarisController@index')->name('inventaris');
    Route::post('inventaris', 'InventarisController@insert')->name('inventaris');
    Route::post('inventaris/update', 'InventarisController@update')->name('inventaris.update');
    Route::get('inventaris/delete/{id}', 'InventarisController@delete');
    Route::get('inventaris/edit/{id}', 'InventarisController@edit');
    /** supporter*/
    Route::get('datasupporter', 'SupporterController@index')->name('datasupporter');
    Route::get('datasupporter/edit/{id}', 'SupporterController@edit');
    Route::post('datasupporter/update', 'SupporterController@update')->name('datasupporter.update');
    /** gallery*/
    Route::get('galeris', 'GaleriController@index')->name('galeri');
    Route::post('galeris', 'GaleriController@insert')->name('galeri');
    Route::get('galeris/delete/{id}', 'GaleriController@delete');
});

Route::middleware(['auth', 'ceklevel:admin'])->group(function () {
    /** keuangan*/
    Route::get('danamasuk', 'KeuanganController@indexmasuk')->name('danamasuk');
    Route::get('danakeluar', 'KeuanganController@indexkeluar')->name('danakeluar');
    Route::get('danasaatini', 'KeuanganController@indexsaatini')->name('danasaatini');
    Route::get('dana/edit', 'KeuanganController@edit')->name('dana.edit');
    Route::get('dana/totalsisa/{tahun}/{bulan}', 'KeuanganController@gettotalsisa');
    Route::post('dana/update', 'KeuanganController@update')->name('dana.update');
    Route::post('dana', 'KeuanganController@insert')->name('dana');
    /** log*/
    Route::get('logmasuk', 'KeuanganController@logmasuk')->name('logmasuk');
    Route::get('logkeluar', 'KeuanganController@logkeluar')->name('logkeluar');
});

Route::middleware(['auth', 'ceklevel:admin,supporter'])->group(function () {
    /** profile*/
    Route::get('setting/profile', 'DashboardController@profile')->name('profile');
    Route::post('setting/profile', 'DashboardController@update')->name('profile.update');
    /** jadwal*/
    Route::get('jadwals', 'JadwalController@index')->name('jadwal');
    Route::get('pengumuman', 'JadwalController@pengumuman')->name('pengumuman');
    Route::post('jadwals', 'JadwalController@insert')->name('jadwal');
    Route::post('jadwals/update', 'JadwalController@update')->name('jadwal.update');
    Route::get('jadwals/delete/{id}', 'JadwalController@delete');
    Route::get('jadwals/edit/{id}', 'JadwalController@edit');
});

/** END HALAMAN MULTI AKSES USER */


/** halaman home diakses admin */
Route::middleware(['auth', 'ceklevel:admin'])->group(function () {
    /** dashboard admin*/
    Route::get('admin', 'DashboardController@index')->name('admin');
    Route::get('info', 'DashboardController@index')->name('info');
    Route::post('info', 'DashboardController@insert')->name('info');
    Route::post('info/update', 'DashboardController@updateinfo')->name('info.update');
    Route::get('info/delete/{id}', 'DashboardController@infodelete');
    Route::get('info/edit/{id}', 'DashboardController@infoedit');
});

/** halaman home diakses supporter */
Route::middleware(['auth', 'ceklevel:supporter'])->group(function () {
    /** dashboard supporter*/
    Route::get('supporter', 'DashboardController@index')->name('supporter');
});

// Login
Route::middleware(['guest'])->group(function () {
    Route::get('login', 'LoginController@getLogin')->name('login');
    Route::post('login', 'LoginController@postLogin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('logout', 'LoginController@logout')->name('logout');
});

// daftar
Route::get('register', 'LoginController@register')->name('register');
Route::post('register', 'LoginController@postregister')->name('register');
