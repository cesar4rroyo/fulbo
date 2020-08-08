<?php

use App\Http\Controllers\FotoTempatPenyewaanCarouselController;
use App\Http\Controllers\FotoTempatPenyewaanController;
use App\Http\Controllers\FotoTempatPenyewaanImageController;
use App\Http\Controllers\FotoTempatPenyewaanThumbController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PemesananPenyewaController;
use App\Http\Controllers\PenyewaProfileManagementFormController;
use App\Http\Controllers\PenyewaProfileManagementHandlerController;
use App\Http\Controllers\PenyewaRegistrationFormController;
use App\Http\Controllers\PenyewaRegistrationHandlerController;
use App\Http\Controllers\TempatPenyewaanController;
use App\Http\Controllers\TempatPenyewaanLocationController;
use App\Http\Controllers\TempatPenyewaanPageController;
use App\Http\Controllers\TempatPenyewaanProfileManagementFormController;
use App\Http\Controllers\TempatPenyewaanProfileManagementHandlerController;
use App\Http\Controllers\TempatPenyewaanRegistrationFormController;
use App\Http\Controllers\TempatPenyewaanRegistrationHandlerController;
use App\Http\Controllers\WelcomeController;
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

Auth::routes([
    "register" => false,
    "reset" => false,
    "confirm" => false,
    "verify" => false,
]);

Route::get("/", class_basename(WelcomeController::class))
    ->name("welcome");

Route::resource('tempat-penyewaan', class_basename(TempatPenyewaanController::class))
    ->only(['index']);

Route::resource('tempat-penyewaan.lapangan', class_basename(LapanganController::class))
    ->except(['show', 'destroy'])
    ->shallow();

Route::resource('tempat-penyewaan.foto', class_basename(FotoTempatPenyewaanController::class))
    ->except(["show"])
    ->shallow();

Route::resource('tempat-penyewaan.pemesanan-penyewa', class_basename(PemesananPenyewaController::class))
    ->only(['index', 'create', 'store', 'destroy'])
    ->shallow();

Route::get('tempat-penyewaan/{tempat_penyewaan}/page', class_basename(TempatPenyewaanPageController::class))
    ->name('tempat-penyewaan.page');

Route::get('/foto/{foto}/image', class_basename(FotoTempatPenyewaanImageController::class))
    ->name('foto.image.show');

Route::get('/foto/{foto}/thumb', class_basename(FotoTempatPenyewaanThumbController::class))
    ->name('foto.thumb.show');

Route::get('/foto/{foto}/carousel', class_basename(FotoTempatPenyewaanCarouselController::class))
    ->name('foto.carousel.show');

Route::resource('tempat-penyewaan.location', class_basename(TempatPenyewaanLocationController::class))
    ->only(['edit', 'update'])
    ->parameter('location', 'tempat_penyewaan');

Route::get('/penyewa-registration', class_basename(PenyewaRegistrationFormController::class))
    ->name("penyewa-registration");
Route::post('/penyewa-registration', class_basename(PenyewaRegistrationHandlerController::class))
    ->name('penyewa-registration');

Route::get('/penyewa-profile-management', class_basename(PenyewaProfileManagementFormController::class))
    ->name("penyewa-profile-management");
Route::put('/penyewa-profile-management', class_basename(PenyewaProfileManagementHandlerController::class))
    ->name('penyewa-profile-management');

Route::get('/tempat-penyewaan-registration', class_basename(TempatPenyewaanRegistrationFormController::class))
    ->name('tempat-penyewaan-registration');
Route::post('/tempat-penyewaan-registration', class_basename(TempatPenyewaanRegistrationHandlerController::class))
    ->name('tempat-penyewaan-registration');

Route::get('/tempat-penyewaan-profile-management', class_basename(TempatPenyewaanProfileManagementFormController::class))
    ->name("tempat-penyewaan-profile-management");
Route::put('/tempat-penyewaan-profile-management', class_basename(TempatPenyewaanProfileManagementHandlerController::class))
    ->name('tempat-penyewaan-profile-management');
