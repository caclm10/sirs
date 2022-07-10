<?php

use App\Http\Controllers\PresenController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Rapot\NilaiEkskulController;
use App\Http\Controllers\Rapot\NilaiMapelController;
use App\Http\Controllers\Rapot\NilaiSikapController;
use App\Http\Controllers\Rapot\PrestasiController;
use App\Http\Controllers\Rapot\RapotController;
use App\Http\Controllers\RekapPresensiController;
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

Route::redirect('/', '/masuk');

Route::middleware(['guest:wali_kelas,siswa,admin'])->group(function () {
    Route::get('/masuk', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
    Route::get('/masuk/admin', [\App\Http\Controllers\Auth\Admin\LoginController::class, 'index'])->name('login.admin');
    Route::post('/masuk/admin/otentikasi', [\App\Http\Controllers\Auth\Admin\LoginController::class, 'authenticate'])->name('authenticate.admin');
    Route::post('/masuk/otentikasi', [\App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('authenticate');
});
Route::get('/keluar', LogoutController::class)->name('logout');


Route::prefix('dashboard')->middleware(['auth:wali_kelas,siswa,admin'])->name('dashboard.')->group(function () {
    // Rapot
    Route::prefix('rapot')->name('rapot.')->group(function () {
        Route::get('', [RapotController::class, 'index'])->name('index');

        Route::prefix('{nis}')->middleware(['auth:wali_kelas'])->group(function () {
            Route::get('', [RapotController::class, 'show'])->name('show');
            Route::patch('sikap', [NilaiSikapController::class, 'update'])->name('sikap.update');

            Route::resource('mapel', NilaiMapelController::class)->except(['index']);

            Route::resource('ekskul', NilaiEkskulController::class)->except(['index']);
            Route::resource('prestasi', PrestasiController::class)->except(['index']);
        });
    });

    // Presensi
    Route::prefix('presensi')->name('presensi.')->group(function () {
        Route::get('', [PresensiController::class, 'index'])->name('index');
        Route::get('presensi/{presensi}', [PresensiController::class, 'presensi'])->name('presensi');
        Route::post('presensi/{presensi}', [PresensiController::class, 'presen'])->name('presen');
    });

    Route::prefix('riwayat-presensi')->name('rekap-presensi.')->group(function () {
        Route::get('/', [RekapPresensiController::class, 'index'])->name('index');
    });



    // Admin
    Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('siswa', \App\Http\Controllers\Admin\SiswaController::class);
        Route::resource('wali-kelas', \App\Http\Controllers\Admin\WaliKelasController::class);
        Route::resource('admin', \App\Http\Controllers\Admin\AdminController::class);
        Route::resource('kelas', \App\Http\Controllers\Admin\KelasController::class);
        Route::resource('mapel', \App\Http\Controllers\Admin\MapelController::class);
        Route::resource('ekskul', \App\Http\Controllers\Admin\EkskulController::class);
        Route::resource('predikat-sikap', \App\Http\Controllers\Admin\PredikatSikapController::class);


        Route::prefix('presensi')->name('presensi.')->group(function () {
            Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
                Route::get('/', [\App\Http\Controllers\Admin\PengaturanPresensiController::class, 'index'])->name('index');
                Route::post('/tanggal-libur', [\App\Http\Controllers\Admin\PengaturanPresensiController::class, 'storeTanggalLibur'])->name('storeTanggalLibur');
                Route::delete('/tanggal-libur/{tanggalLibur}', [\App\Http\Controllers\Admin\PengaturanPresensiController::class, 'destroyTanggalLibur'])
                    ->name('destroyTanggalLibur');
                Route::put('/ganjil', [\App\Http\Controllers\Admin\PengaturanPresensiController::class, 'updateJadwalGanjil'])->name('updateJadwalGanjil');
                Route::put('/genap', [\App\Http\Controllers\Admin\PengaturanPresensiController::class, 'updateJadwalGenap'])->name('updateJadwalGenap');
            });
        });

        Route::resource('presensi', \App\Http\Controllers\Admin\PresensiController::class);
    });


    // Profil
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('index');
        Route::patch('', [ProfileController::class, 'update'])->name('update');
    });
});
