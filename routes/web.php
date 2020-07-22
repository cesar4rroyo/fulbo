<?php

use App\Http\Controllers\PenyewaProfileManagementFormController;
use App\Http\Controllers\PenyewaProfileManagementHandlerController;
use App\Http\Controllers\PenyewaRegistrationFormController;
use App\Http\Controllers\PenyewaRegistrationHandlerController;
use App\Http\Controllers\TempatPenyewaanController;
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

Route::get('/', function () {
    return view('welcome');
})->name("welcome");

Auth::routes();

Route::resource('/tempat-penyewaan', class_basename(TempatPenyewaanController::class));
Route::get('/penyewa-registration', class_basename(PenyewaRegistrationFormController::class))
    ->name("penyewa-registration");
Route::post('/penyewa-registration', class_basename(PenyewaRegistrationHandlerController::class))
    ->name('penyewa-registration');

Route::get('/penyewa-profile-management', class_basename(PenyewaProfileManagementFormController::class))
    ->name("penyewa-profile-management");
Route::put('/penyewa-profile-management', class_basename(PenyewaProfileManagementHandlerController::class))
    ->name('penyewa-profile-management');
