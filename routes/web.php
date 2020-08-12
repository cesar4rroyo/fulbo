<?php

use App\Http\Controllers\FotoTempatPenyewaanCarouselController;
use App\Http\Controllers\FotoTempatPenyewaanController;
use App\Http\Controllers\FotoTempatPenyewaanImageController;
use App\Http\Controllers\FotoTempatPenyewaanThumbController;
use App\Http\Controllers\GuestTempatPenyewaanIndexController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\MemberTempatPenyewaanByTempatPenyewaanController;
use App\Http\Controllers\PembayaranMemberController;
use App\Http\Controllers\PemesananByMemberTempatPenyewaan;
use App\Http\Controllers\PemesananPenyewaUpdateStatusController;
use App\Http\Controllers\PemesananPenyewaController;
use App\Http\Controllers\PemesananTempatPenyewaanUpdateStatusController;
use App\Http\Controllers\TempatPenyewaanPemesananController;
use App\Http\Controllers\TempatPenyewaanPemesananPenyewaController;
use App\Http\Controllers\PenyewaProfileManagementFormController;
use App\Http\Controllers\PenyewaProfileManagementHandlerController;
use App\Http\Controllers\PenyewaRegistrationFormController;
use App\Http\Controllers\PenyewaRegistrationHandlerController;
use App\Http\Controllers\TempatPenyewaanController;
use App\Http\Controllers\TempatPenyewaanHargaPemesananController;
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

Route::get("guest-tempat-penyewaan-index", class_basename(GuestTempatPenyewaanIndexController::class))
    ->name("guest-tempat-penyewaan-index");

Route::resource('tempat-penyewaan', class_basename(TempatPenyewaanController::class))
    ->only(['index']);

Route::resource('tempat-penyewaan.lapangan', class_basename(LapanganController::class))
    ->except(['show', 'destroy'])
    ->shallow();

Route::resource('tempat-penyewaan.foto', class_basename(FotoTempatPenyewaanController::class))
    ->except(["show"])
    ->shallow();

Route::resource('tempat-penyewaan.pemesanan-penyewa', class_basename(TempatPenyewaanPemesananPenyewaController::class))
    ->only(['create', 'store'])
    ->shallow();

Route::resource('tempat-penyewaan.pemesanan-by-tempat', class_basename(TempatPenyewaanPemesananController::class))
    ->parameter('pemesanan-by-tempat', 'pemesanan')
    ->only(['index', 'show'])
    ->shallow();

Route::resource('tempat-penyewaan.member-tempat-penyewaan-by-tempat-penyewaan', class_basename(MemberTempatPenyewaanByTempatPenyewaanController::class))
    ->only(['index', 'create', 'edit', 'update'])
    ->parameter('member-tempat-penyewaan-by-tempat-penyewaan', 'member-tempat-penyewaan')
    ->shallow();

Route::resource('member-tempat-penyewaan.pemesanan-by-member-tempat-penyewaan', class_basename(PemesananByMemberTempatPenyewaan::class))
    ->only(['create', 'store'])
    ->parameters([
        'pemesanan-by-member-tempat-penyewaan' => 'pemesanan',
    ])
    ->shallow();

Route::resource('pemesanan-penyewa', class_basename(PemesananPenyewaController::class))
    ->parameter('pemesanan-penyewa', 'pemesanan')
    ->shallow();

Route::put('pemesanan-penyewa/{pemesanan}/update-status', class_basename(PemesananPenyewaUpdateStatusController::class))
    ->name('pemesanan-penyewa.update-status');

Route::put('pemesanan-tempat-penyewaan/{pemesanan}/update-status', class_basename(PemesananTempatPenyewaanUpdateStatusController::class))
    ->name('pemesanan-tempat-penyewaan.update-status');

Route::resource('tempat-penyewaan.harga-pemesanan', class_basename(TempatPenyewaanHargaPemesananController::class))
    ->only(['index', 'edit', 'update'])
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
