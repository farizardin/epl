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
    $users = \App\User::all();

    return view('auth.login', compact('users'));
})->middleware('guest');

//Auth::routes();

// Login Routes
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/changepassword', 'UserController@changePassword')->name('changepassword');
Route::post('/changepassword', 'UserController@changePasswordAct')->name('changepasswordact');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user', 'UserController@index')->name('user');
Route::post('/user', 'UserController@store')->name('user.store');
Route::put('/user/{id}/update', 'UserController@update')->name('user.update');
Route::delete('/user/{id}/delete', 'UserController@destroy')->name('user.destroy');

Route::get('/role', 'RoleController@index')->name('role');
Route::put('/role/{id}/update', 'RoleController@update')->name('role.update');

Route::get('/pasar', 'PasarController@index')->name('pasar');
Route::post('/pasar', 'PasarController@store')->name('pasar.store');
Route::put('/pasar/{id}/update', 'PasarController@update')->name('pasar.update');
Route::delete('/pasar/{id}/delete', 'PasarController@destroy')->name('pasar.destroy');

Route::get('/stand', 'StandController@index')->name('stand');
Route::post('/stand', 'StandController@store')->name('stand.store');
Route::get('/stand/{id}', 'StandController@edit')->name('stand.edit');
Route::put('/stand/{id}/update', 'StandController@update')->name('stand.update');
Route::get('/stand/{id}/pedagang', 'StandController@edit_pedagang')->name('stand.edit_pedagang');
Route::put('/stand/{id}/pedagang/update', 'StandController@update_pedagang')->name('stand.update_pedagang');
Route::put('/stand/{id}/buku/update', 'StandController@update_bhptu')->name('stand.update.bhptu');
Route::put('/stand/{id}/kartu/update', 'StandController@update_pptu')->name('stand.update.pptu');
Route::delete('/stand/{id}/delete', 'StandController@destroy')->name('stand.destroy');
Route::put('/stand/{id}/segel', 'StandController@segel')->name('stand.segel');
Route::put('/stand/{id}/cabut', 'StandController@cabut')->name('stand.cabut');

Route::get('/proses', 'ProsesController@index')->name('proses');
Route::get('/proses/baru', 'ProsesController@create')->name('proses.create');
Route::post('/proses/baru', 'ProsesController@store')->name('proses.store');
Route::put('/proses/{id}/update', 'ProsesController@update')->name('proses.update');
Route::get('/proses/{id}', 'ProsesController@detail')->name('proses.detail');
Route::post('/proses/{id}/validasi', 'ProsesController@validasi')->name('proses.validasi');

Route::get('/tarif', 'TarifController@index')->name('tarif');
Route::post('/tarif', 'TarifController@store')->name('tarif.store');
Route::put('/tarif/{id}/update', 'TarifController@update')->name('tarif.update');
Route::delete('/tarif/{id}/delete', 'TarifController@destroy')->name('tarif.destroy');

Route::post('/ajax/getpedagang', 'AjaxController@getPedagang')->name('ajax.getpedagang');
Route::post('/ajax/getbiayait', 'AjaxController@getBiayaIT')->name('ajax.getbiayait');
Route::post('/ajax/getbiayabn', 'AjaxController@getBiayaBN')->name('ajax.getbiayabn');
Route::post('/ajax/getbiayaher', 'AjaxController@getBiayaHer')->name('ajax.getbiayaher');
Route::post('/ajax/getbiayasij', 'AjaxController@getBiayaSIJ')->name('ajax.getbiayasij');
Route::post('/ajax/getbiayasib', 'AjaxController@getBiayaSIB')->name('ajax.getbiayasib');
Route::post('/ajax/getbiayaips', 'AjaxController@getBiayaIPS')->name('ajax.getbiayaips');
Route::post('/ajax/getbiayabtu', 'AjaxController@getBiayaBTU')->name('ajax.getbiayabtu');
Route::post('/ajax/getbiayagantibuku', 'AjaxController@getBiayaGantiBuku')->name('ajax.getbiayagantibuku');
Route::post('/ajax/getbiayappn', 'AjaxController@getBiayaPPN')->name('ajax.getbiayappn');
Route::post('/ajax/generatemoneyformat', 'AjaxController@generateMoneyFormat')->name('ajax.generatemoneyformat');

Route::get('/cetak/rekapitulasi', 'PDFController@cetak_rekap')->name('cetak.rekap');
Route::get('/cetak/kuitansi/{id}', 'PDFController@cetak_kuitansi')->name('cetak.kuitansi');
Route::get('/cetak/kartu/{id}', 'PDFController@cetak_kartu')->name('cetak.kartu');
Route::get('/cetak/bkmc/{id}', 'PDFController@cetak_bkmc')->name('cetak.bkmc');
Route::get('/cetak/tandapenerimaan/{id}', 'PDFController@cetak_tandapenerimaan')->name('cetak.tandapenerimaan');
Route::get('/cetak/pptu/{id}', 'PDFController@cetak_pptu')->name('cetak.pptu');
Route::get('/cetak/buku/{id}', 'PDFController@cetak_buku')->name('cetak.buku');
Route::get('/cetak/blangko/{id}', 'PDFController@cetak_blangko')->name('cetak.blangko');
Route::get('/cetak/suratpernyataan/{id}', 'PDFController@cetak_suratpernyataan')->name('cetak.suratpernyataan');
Route::get('/cetak/beritaacara/{id}', 'PDFController@cetak_beritaacara')->name('cetak.beritaacara');


Route::get('/laporan', 'LaporanController@index')->name('laporan');
Route::post('/laporan/excel', 'LaporanController@exportLaporan')->name('laporan.export');
Route::get('/export/data', 'LaporanController@exportData')->name('export.data');

use Barryvdh\DomPDF\Facade as PDF;

Route::get('/test', function() {
    $pdf = PDF::loadView('pdf.beritaacara')->setPaper('a4', 'portrait');

    return $pdf->stream();
});