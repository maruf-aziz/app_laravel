<?php

use App\Http\Controllers\NasabahController;
use App\Http\Controllers\SuamiIstriController;
use App\Http\Controllers\EmergencyContactController;
use App\Http\Controllers\PermohonanPinjamanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PDFController;
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
    // return view('welcome');
    return view('admin.home.home');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('nasabah', NasabahController::class);
    Route::get('send-mail', [NasabahController::class, 'sendmail']);
    Route::get('nasabahlist', [NasabahController::class, 'getNasabah'])->name('nasabah.list');
    Route::resource('suami-istri', SuamiIstriController::class);
    Route::get('add-suami-istri/{id}', [SuamiIstriController::class, 'create2']);
    Route::resource('emergency-contact', EmergencyContactController::class);
    Route::resource('permohonan-pinjaman', PermohonanPinjamanController::class);
    Route::resource('roles', RoleController::class);
});

Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
