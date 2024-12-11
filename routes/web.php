<?php

use App\Http\Controllers\Admin\JuriController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pembina\RegistrasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () { return view('home'); });
Route::get('/login', function () {return redirect()->route('login');});
Route::get('/login', function () {return view('auth.login');})->name('login');
Route::post('/login', \App\Http\Controllers\Auth\LoginController::class)->name('login.attempt');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', \App\Http\Controllers\Auth\RegisterController::class)->name('register.attempt');
Route::post('/logout', \App\Http\Controllers\Auth\LogoutController::class)->name('logout');
Route::get('/download-template/{templateId}', [\App\Http\Controllers\Admin\TemplateDokumenController::class, 'downloadTemplate'])->name('downloadTemplate');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {

        $pembinas = \App\Models\Pembina::all();
        return view('admin.dashboard', compact('pembinas'));
    })->name('admin.dashboard')->middleware(['role:admin']);
    Route::resource('verif_dokumen', \App\Http\Controllers\DashboardController::class)->middleware(['role:admin']);
    Route::resource('dokumen', \App\Http\Controllers\Admin\TemplateDokumenController::class)->middleware(['role:admin']);
    Route::prefix('peserta')->group(function () {
        Route::get('/data-peserta', [\App\Http\Controllers\Admin\PesertaController::class, 'index'])->name('admin.peserta.index')->middleware(['role:admin']);
        Route::get('/peserta/{id}', [\App\Http\Controllers\Admin\PesertaController::class, 'show'])->name('admin.peserta.show')->middleware(['role:admin']);
        Route::get('/peserta/{id}/edit', [\App\Http\Controllers\Admin\PesertaController::class, 'edit'])->name('admin.peserta.edit')->middleware(['role:admin']);
        Route::put('/peserta/{id}', [\App\Http\Controllers\Admin\PesertaController::class, 'update'])->name('admin.peserta.update')->middleware(['role:admin']);
        Route::delete('/peserta/{id}', [\App\Http\Controllers\Admin\PesertaController::class, 'destroy'])->name('admin.peserta.destroy')->middleware(['role:admin']);
    });

    Route::prefix('mata-lomba')->group(function () {
        Route::get('/data-mata-lomba', [\App\Http\Controllers\Admin\MataLomba::class, 'index'])->name('admin.mata-lomba.index')->middleware(['role:admin']);
        Route::post('/mata-lomba', [\App\Http\Controllers\Admin\MataLomba::class, 'store'])->name('admin.mata-lomba.store')->middleware(['role:admin']);
        Route::get('/mata-lomba/create', [\App\Http\Controllers\Admin\MataLomba::class, 'create'])->name('admin.mata-lomba.create')->middleware(['role:admin']);
        Route::get('/mata-lomba/{id}/edit', [App\Http\Controllers\Admin\MataLomba::class, 'edit'])->name('admin.mata-lomba.edit')->middleware(['role:admin']);
        Route::get('/mata-lomba/{id}', [App\Http\Controllers\Admin\MataLomba::class, 'show'])->name('admin.mata-lomba.show')->middleware(['role:admin']);
        Route::put('/mata-lomba/{id}', [App\Http\Controllers\Admin\MataLomba::class, 'update'])->name('admin.mata-lomba.update')->middleware(['role:admin']);
        Route::delete('/mata-lomba/{id}', [App\Http\Controllers\Admin\MataLomba::class, 'destroy'])->name('admin.mata-lomba.destroy')->middleware(['role:admin']);
    });

    Route::prefix('pembina')->group(function () {
        Route::get('/data-pembina', [\App\Http\Controllers\Admin\PembinaController::class, 'index'])->name('admin.pembina.index')->middleware(['role:admin']);
        Route::get('/pembina/create', [\App\Http\Controllers\Admin\PembinaController::class, 'create'])->name('admin.pembina.create')->middleware(['role:admin']);
        Route::get('/pembina/{id}', [\App\Http\Controllers\Admin\PembinaController::class, 'show'])->name('admin.pembina.show')->middleware(['role:admin']);
        Route::post('/pembina', [\App\Http\Controllers\Admin\PembinaController::class, 'store'])->name('admin.pembina.store')->middleware(['role:admin']);
        Route::get('/pembina/{id}/edit', [\App\Http\Controllers\Admin\PembinaController::class, 'edit'])->name('admin.pembina.edit')->middleware(['role:admin']);
        Route::put('/pembina/{id}', [\App\Http\Controllers\Admin\PembinaController::class, 'update'])->name('admin.pembina.update')->middleware(['role:admin']);
        Route::delete('/pembina/{id}', [\App\Http\Controllers\Admin\PembinaController::class, 'destroy'])->name('admin.pembina.destroy')->middleware(['role:admin']);
    });

    Route::prefix('juri')->group(function () {
        Route::resource('/juri', JuriController::class)->middleware(['role:admin']);
        Route::get('/dashboard', function () {
            return view('juri.dashboard');
        })->name('juri.dashboard')->middleware(['role:juri']);
        Route::get('/profil', [App\Http\Controllers\Pembina\RegistrasiController::class, 'registrasi'])->name('profil.juri')->middleware(['role:juri']);
    });
})->middleware(['role:admin']);

// Route dengan prefix 'peserta' dan middleware 'role:peserta'
Route::prefix('peserta')->middleware(['role:peserta'])->group(function () {

    // Dashboard peserta
    Route::get('/dashboard', function () {
        return view('peserta.dashboard');
    })->name('peserta.dashboard');

    // Route untuk upload lomba
    Route::get('/upload-lombas', [App\Http\Controllers\Peserta\UploadLombaController::class, 'upload_lombas'])->name('upload_lombas.form')->middleware(['role:peserta']);
    Route::post('/upload-lombas/store', [App\Http\Controllers\Peserta\UploadLombaController::class, 'store'])->name('upload_lombas.store')->middleware(['role:peserta']);
    Route::delete('/upload-lombas/{id}', [App\Http\Controllers\Peserta\UploadLombaController::class, 'destroy'])->name('upload_lombas.destroy')->middleware(['role:peserta']);
    Route::get('/upload-lombas/edit/{id}', [App\Http\Controllers\Peserta\UploadLombaController::class, 'edit'])->name('upload_lombas.edit')->middleware(['role:peserta']);
    Route::put('/upload-lombas/update/{id}', [App\Http\Controllers\Peserta\UploadLombaController::class, 'update'])->name('upload_lombas.update')->middleware(['role:peserta']);

});


Route::prefix('pembina')->group(function () {
    Route::get('/dashboard', function () {
        return view('pembina.dashboard');
    })->name('pembina.dashboard')->middleware(['role:pembina']);
    Route::get('/registrasi', [App\Http\Controllers\Pembina\RegistrasiController::class, 'registrasi'])->name('registrasi.form')->middleware(['role:pembina']);
    Route::post('/pembina/store', [App\Http\Controllers\Pembina\RegistrasiController::class, 'storePembina'])->name('pembina.store')->middleware(['role:pembina']);
    Route::put('/pembina', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'updatePembina'])->name('pembina.update')->middleware(['role:pembina']);
    Route::post('/regu', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'storeRegu'])->name('regu.store')->middleware(['role:pembina']);
    Route::put('/regu/{regu}/update', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'updateRegu'])->name('regu.update')->middleware(['role:pembina']);
    Route::delete('/regu/{regu}/destroy', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'destroyRegu'])->name('regu.destroy');
    Route::post('/peserta/store', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'storePeserta'])->name('peserta.store')->middleware(['role:pembina']);
    Route::put('/peserta/{peserta}/update', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'updatePeserta'])->name('peserta.update')->middleware(['role:pembina']);
    Route::delete('/peserta/{peserta}/destroy', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'destroyPeserta'])->name('peserta.destroy')->middleware(['role:pembina']);
    Route::post('/dokumen-persyaratan', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'storeDokumen'])->name('upload_dokumen.store')->middleware(['role:pembina']);
    Route::resource('data-peserta', \App\Http\Controllers\Pembina\PesertaController::class)->middleware(['role:pembina']);
    Route::post('/finalisasi', [App\Http\Controllers\Pembina\RegistrasiController::class, 'finalisasi'])->name('finalisasi')->middleware(['role:pembina']);
    Route::post('/peserta/import', [\App\Http\Controllers\Pembina\PesertaController::class, 'import'])->name('peserta.import');
})->middleware(['role:pembina']);
Route::prefix('juri')->group(function () {
    Route::get('/dashboard', function () {
        return view('juri.dashboard');
    })->name('juri.dashboard')->middleware(['role:juri']);
    Route::resource('/penilaian-karikatur', \App\Http\Controllers\Juri\PenilaianKarikatur::class)->middleware(['role:juri']);
    Route::resource('/penilaian-pioneering', \App\Http\Controllers\Juri\PenilaianPioneering::class)->middleware(['role:juri']);
})->middleware(['role:juri']);

Route::get('/edit-profile', [\App\Http\Controllers\DashboardController::class, 'editProfile'])->name('editProfile'); 
Route::post('/update-profile', [\App\Http\Controllers\DashboardController::class, 'updateProfile'])->name('updateProfile');

