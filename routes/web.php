<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\GuruUserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\ChatbotController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| SISWA (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/siswa',
        [SiswaDashboardController::class, 'index']);

    Route::get('/dashboard-realtime',
        [SiswaDashboardController::class, 'realtime']);

    /*
    |--------------------------------------------------------------------------
    | PROFIL
    |--------------------------------------------------------------------------
    */
    Route::get('/siswa/profil', function () {
        return view('siswa.profil');
    });

    Route::post('/upload-foto',
        [UserController::class, 'uploadFoto']);
    
    Route::post('/profil/ganti-password', [UserController::class, 'gantiPassword'])
        ->name('profil.gantiPassword');

    /*
    |--------------------------------------------------------------------------
    | CHATBOT
    |--------------------------------------------------------------------------
    */
    Route::get('/chatbot', [ChatbotController::class, 'index']);
    Route::post('/chatbot/chat', [ChatbotController::class, 'chat']);

    /*
    |--------------------------------------------------------------------------
    | Panduan
    |--------------------------------------------------------------------------
    */
    Route::get('/panduan-konseling', function () {
    return view('siswa.panduan');
    });

    /*
    |--------------------------------------------------------------------------
    | LAPORAN SISWA
    |--------------------------------------------------------------------------
    */
    Route::get('/laporan_saya',
        [PengaduanController::class, 'laporanSaya'])
        ->name('laporan.saya');

    Route::get('/buat-laporan',
        [PengaduanController::class, 'create'])
        ->name('laporan.create');

    Route::post('/buat-laporan',
        [PengaduanController::class, 'store'])
        ->name('laporan.store');

    Route::get('/pengaduan/{id}',
        [PengaduanController::class, 'show'])
        ->name('pengaduan.show');
        

});

/*
|--------------------------------------------------------------------------
| GURU BK (LOGIN + ROLE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','guru'])->group(function () {

    Route::get('/guru',
        [GuruDashboardController::class, 'index']);

    Route::get('/guru/realtime',
        [GuruDashboardController::class, 'realtime']);

    Route::get('/guru/laporan',
        [GuruDashboardController::class, 'kelolaLaporan'])
        ->name('guru.laporan');

    Route::get('/guru/respon/{id}',
        [GuruDashboardController::class, 'respon'])
        ->name('guru.respon');

    Route::get('/respon-saya',
        [PengaduanController::class, 'responIndex'])
        ->name('respon.saya');

    Route::post('/guru/respon/{id}',
        [PengaduanController::class, 'storeRespon'])
        ->name('guru.respon.store');

    Route::get('/guru/respon/{id}/edit',
        [PengaduanController::class, 'edit'])
        ->name('laporan.edit');
    
    

    /*
    |------------------------------------------------------------------
    | PROFIL GURU
    |------------------------------------------------------------------
    */
    Route::get('/guru/profil', function () {
        return view('guru.profil');
    });

    /*
    |--------------------------------------------------------------------------
    | KELOLA USER
    |--------------------------------------------------------------------------
    */
    Route::get('/kelola-user',
        [GuruUserController::class, 'index']);
    
    Route::get('/tambah-user', function () {
    return view('guru.tambah-user');
    });

    Route::post('/kelola-user/store',
        [GuruUserController::class, 'store']);

    Route::put('/kelola-user/update/{id}',
        [GuruUserController::class, 'update']);

    Route::delete('/kelola-user/delete/{id}',
    [   GuruUserController::class, 'destroy']); 

    

    
    /*
    |--------------------------------------------------------------------------
    | Kelola Kategori
    |--------------------------------------------------------------------------
    */
    Route::resource('kategori', KategoriController::class);
    Route::post('/kategori/store', [KategoriController::class, 'store'])
        ->name('guru.kategori.store');

    Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])
        ->name('kategori.update');

    Route::delete('/kategori/delete/{id}', [KategoriController::class, 'destroy'])
     ->name('kategori.destroy');

    /*
    |--------------------------------------------------------------------------
    | Kelola Analisis
    |--------------------------------------------------------------------------
    */
    Route::get('/analisis', [AnalisisController::class, 'index'])
     ->name('guru.analisis');
    Route::get('/guru/analisis/pdf',[AnalisisController::class, 'exportPdf'])
        ->name('guru.analisis.pdf');
});

/*
|--------------------------------------------------------------------------
| PENGADUAN (OPTIONAL PUBLIC / API)
|--------------------------------------------------------------------------
*/
Route::get('/laporan-terbaru', [PengaduanController::class, 'getTerbaru']);

/*
|--------------------------------------------------------------------------
| NOTIFIKASI
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
    Route::get('/notif', [NotifikasiController::class, 'getNotif']);
    Route::get('/notif-terbaru', [NotifikasiController::class, 'notifDashboard']);
    Route::get('/notif-count', [NotifikasiController::class, 'count']);

    // 🔥 FIX: pakai POST (bukan GET)
    Route::post('/notif-read', [NotifikasiController::class, 'markAsRead']);

    Route::get('/notif/hapus/{id}', [NotifikasiController::class, 'hapus'])->name('notif.hapus');
});

/*
|--------------------------------------------------------------------------
| LOGOUT TEST
|--------------------------------------------------------------------------
*/
Route::get('/logout-test', function () {
    auth()->logout();
    return redirect('/');
});

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN, REGISTER, DLL)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';