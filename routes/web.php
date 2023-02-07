<?php

use App\Http\Controllers\NasabahController;
use App\Http\Controllers\SuamiIstriController;
use App\Http\Controllers\EmergencyContactController;
use App\Http\Controllers\PermohonanPinjamanController;
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

Route::resource('nasabah', NasabahController::class);
Route::resource('suami-istri', SuamiIstriController::class);
Route::resource('emergency-contact', EmergencyContactController::class);
Route::resource('permohonan-pinjaman', PermohonanPinjamanController::class);

