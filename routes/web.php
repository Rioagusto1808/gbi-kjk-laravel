<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\DashboardJemaatController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventPesertaController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\IbadahController;
use App\Http\Controllers\JemaatController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KontakKamiController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RenunganController;
use App\Http\Controllers\TimPelayananController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (tanpa login)
|--------------------------------------------------------------------------
*/

Route::get('/', [BerandaController::class, 'index'])->name('home');

Route::get('/berita', [BeritaController::class, 'indexPublic'])
    ->name('berita.public.index');

Route::get('/berita/{berita}', [BeritaController::class, 'show'])
    ->name('berita.public.show');

    // Renungan publik
Route::get('/renungan', [RenunganController::class, 'indexPublic'])->name('renungan.public.index');
Route::get('/renungan/{renungan}', [RenunganController::class, 'showPublic'])->name('renungan.public.show');

Route::get('/jadwal', [IbadahController::class, 'indexPublic'])
    ->name('jadwal.public.index');

Route::get('/events', [EventController::class, 'publicIndex'])
    ->name('event.public.index');

Route::post('/kontak-kami', [KontakKamiController::class, 'store'])
    ->name('kontak.store');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'check_status_user', 'verified'])->group(function () {

    // ================= Dashboard Redirect =================
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole(['superadmin', 'admin'])) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('jemaat.dashboard');
        }
    })->name('dashboard');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.all');

    // Tandai semua sudah dibaca
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])
        ->name('notifications.readall');

    // Tandai satu notifikasi sudah dibaca (opsional)
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'read'])
        ->name('notifications.read');

    // ================= Profil Jemaat =================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/user', [ProfileController::class, 'updateUser'])->name('profile.update.user');
    Route::patch('/profile/jemaat', [ProfileController::class, 'updateJemaat'])->name('profile.update.jemaat');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/remove-photo', [ProfileController::class, 'removePhoto'])
        ->name('profile.removePhoto');

    Route::middleware(['role:jemaat'])->group(function () {
        Route::get('jemaat/dashboard', [DashboardJemaatController::class, 'index'])
            ->name('jemaat.dashboard');
        Route::get('jemaat/ibadah', [IbadahController::class, 'jemaatIndex'])->name('jemaat.ibadah.index');
        Route::get('/jemaat/pelayanan', [PelayananController::class, 'jemaatIndex'])->name('jemaat.pelayanan.index');
        Route::get('/jemaat/pelayanan/{pelayanan}', [PelayananController::class, 'show'])->name('jemaat.pelayanan.show');
        Route::get('jemaat/ibadah/{ibadah}/tim-pelayanan', [TimPelayananController::class, 'jemaatIndex'])
            ->name('jemaat.tim-pelayanan.index');
        Route::get('jemaat/tim-pelayanan', [TimPelayananController::class, 'overviewJemaat'])
            ->name('jemaat.tim-pelayanan.overview');

        Route::get('jemaat/renungan', [RenunganController::class, 'jemaatIndex'])->name('jemaat.renungan.index');
        Route::get('jemaat/renungan/{renungan}', [RenunganController::class, 'jemaatShow'])->name('jemaat.renungan.show');
        Route::get('event', [EventController::class, 'jemaatIndex'])->name('jemaat.event.index');
        Route::get('event/{event}', [EventController::class, 'jemaatShow'])->name('jemaat.event.show');
        Route::post('event/{event}/daftar', [EventPesertaController::class, 'daftar'])->name('event.daftar');
    });

    /*
    |--------------------------------------------------------------------------
    | Management Data Jemaat (Admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:superadmin|admin'])->group(function () {
        Route::get('admin/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');
        Route::resource('admin/jemaat', JemaatController::class);
        Route::get('/jemaat/deleted', [JemaatController::class, 'deleted'])
            ->name('jemaat.deleted');
        Route::get('/jemaat/restore', [JemaatController::class, 'restore'])
            ->name('jemaat.restore');
        Route::get('/jemaat/force-delete', [JemaatController::class, 'forceDelete'])
            ->name('jemaat.force-delete');
        Route::resource('admin/ibadah', IbadahController::class)->except(['show']);
        Route::resource('admin/event', EventController::class)->except(['show']);
        Route::resource('admin/keuangan', KeuanganController::class);
        Route::resource('admin/berita', BeritaController::class)->parameters([
            'berita' => 'berita'])->except(['show']);
        Route::get('admin/berita/deleted', [BeritaController::class, 'deleted'])->name('berita.deleted');
        Route::post('admin/berita/{id}/restore', [BeritaController::class, 'restore'])->name('berita.restore');
        Route::delete('admin/berita/{id}/force-delete', [BeritaController::class, 'forceDelete'])->name('berita.force-delete');
        Route::resource('files', FileController::class)->only(['index', 'store', 'destroy']);
        Route::resource('admin/keluarga', KeluargaController::class);
        Route::resource('admin/pelayanan', PelayananController::class);
        Route::resource('admin/renungan', RenunganController::class)->except(['show']);
        Route::resource('carousel', CarouselController::class)->except(['show']);
        Route::resource('galeri', GaleriController::class)->except(['show']);

        // Peserta Event (PASTIKAN DI SINI, bukan di bawah ibadah)
        Route::get('admin/event/{event}/peserta', [EventPesertaController::class, 'index'])->name('event.peserta');
        Route::patch('admin/event/peserta/{peserta}', [EventPesertaController::class, 'updateStatus'])->name('event.peserta.update');

        Route::get('/kontak', [KontakKamiController::class, 'index'])->name('kontak.index');
        Route::get('/kontak/{kontak}', [KontakKamiController::class, 'show'])->name('kontak.show');
        Route::post('/kontak/{kontak}/reply', [KontakKamiController::class, 'reply'])->name('kontak.reply');
        Route::get('/keuangan/laporan/pdf', [KeuanganController::class, 'laporan'])
                ->name('keuangan.laporan.pdf');

        // Tim pelayanan tetap di bawah ibadah
        Route::get('admin/ibadah/history', [IbadahController::class, 'history'])->name('ibadah.history');
        Route::prefix('admin/ibadah/{ibadah}')->group(function () {
            Route::get('tim-pelayanan', [TimPelayananController::class, 'index'])->name('tim-pelayanan.index');
            Route::get('tim-pelayanan/create', [TimPelayananController::class, 'create'])->name('tim-pelayanan.create');
            Route::post('tim-pelayanan', [TimPelayananController::class, 'store'])->name('tim-pelayanan.store');
            Route::get('tim-pelayanan/{timPelayanan}/edit', [TimPelayananController::class, 'edit'])->name('tim-pelayanan.edit');
            Route::put('tim-pelayanan/{timPelayanan}', [TimPelayananController::class, 'update'])->name('tim-pelayanan.update');
            Route::delete('tim-pelayanan/{timPelayanan}', [TimPelayananController::class, 'destroy'])->name('tim-pelayanan.destroy');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Notifikasi (Hanya Admin/Superadmin)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:superadmin|admin'])->group(function () {
        Route::resource('notifikasi', NotifikasiController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Event Registration (Jemaat & Staff)
    |--------------------------------------------------------------------------
    */
    Route::post('/event/{event}/register', [EventController::class, 'register'])
        ->middleware(['role:jemaat|staff'])
        ->name('event.register');
});
