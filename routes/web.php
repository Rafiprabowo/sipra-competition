<?php

use App\Http\Controllers\Admin\EditSoalTpkController;
use App\Http\Controllers\Admin\ImportSoalTpkController;
use App\Http\Controllers\Admin\JuriController;
use App\Http\Controllers\Admin\PertanyaanTpkController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HasilLombaTpkController;
use App\Http\Controllers\Pembina\RegistrasiController;
use App\Models\Finalisasi;
use App\Models\Peserta;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

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
Route::get('/login', function () {return view('auth.login');})->name('login');
Route::post('/login', \App\Http\Controllers\Auth\LoginController::class)->name('login.attempt');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', \App\Http\Controllers\Auth\RegisterController::class)->name('register.attempt');
Route::post('/logout', \App\Http\Controllers\Auth\LogoutController::class)->name('logout');
Route::get('/download-template/{templateId}', [\App\Http\Controllers\Admin\TemplateDokumenController::class, 'downloadTemplate'])->name('downloadTemplate');
Route::get('/view-file/{fileName}', [\App\Http\Controllers\Admin\TemplateDokumenController::class, 'viewFile'])->name('viewFile');

//Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        $finalisasis = \App\Models\Finalisasi::with('pembina.upload_dokumen')->get();
        return view('admin.dashboard', compact('finalisasis'));
    })->name('admin.dashboard')->middleware(['role:admin']);
    Route::get('/admin/edit-profile-admin', [App\Http\Controllers\Admin\EditProfileAdminController::class, 'editProfileAdmin'])->name('editProfileAdmin')->middleware(['role:admin']);
    Route::put('/admin/update-profile-admin', [App\Http\Controllers\Admin\EditProfileAdminController::class, 'updateProfileAdmin'])->name('updateProfileAdmin')->middleware(['role:admin']);
    Route::resource('users', UserController::class)->middleware(['role:admin']);
    Route::post('/finalisasi/{id}/approve', [\App\Http\Controllers\Admin\FinalisasiController::class, 'approve'])->name('finalisasi.approve');
    Route::post('/finalisasi/{id}/reject', [\App\Http\Controllers\Admin\FinalisasiController::class, 'reject'])->name('finalisasi.reject');
    Route::get('/finalisasi/{id}/edit', [\App\Http\Controllers\Admin\FinalisasiController::class, 'edit'])->name('finalisasi.edit');
    Route::put('/finalisasi/{id}/update', [\App\Http\Controllers\Admin\FinalisasiController::class, 'update'])->name('finalisasi.update');
    Route::get('/view-file/{file}', [\App\Http\Controllers\Admin\FinalisasiController::class, 'view'])->name('viewFile');

    // Route::resource('verif_dokumen', \App\Http\Controllers\DashboardController::class)->middleware(['role:admin']);
    Route::resource('dokumen', \App\Http\Controllers\Admin\TemplateDokumenController::class)->middleware(['role:admin']);
    Route::get('/hasil-nilai/nilai-karikatur', [\App\Http\Controllers\Admin\HasilNilaiKarikaturController::class, 'index'])->name('admin.hasil_nilai.nilai_karikatur');
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

    Route::prefix('sesi-cbt')->group(function(){
        Route::get('/index', [\App\Http\Controllers\Admin\ManajemenSesiCbtController::class, 'index'])->name('sesi-cbt.index');
        Route::get('/create', [\App\Http\Controllers\Admin\ManajemenSesiCbtController::class, 'create'])->name('sesi-cbt.create');
        Route::post('/store', [\App\Http\Controllers\Admin\ManajemenSesiCbtController::class, 'store'])->name('sesi-cbt.store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\ManajemenSesiCbtController::class, 'edit'])->name('sesi-cbt.edit');
        Route::put('/{id}/update', [\App\Http\Controllers\Admin\ManajemenSesiCbtController::class, 'update'])->name('sesi-cbt.update');
        Route::delete('/{id}/delete', [\App\Http\Controllers\Admin\ManajemenSesiCbtController::class, 'destroy'])->name('sesi-cbt.destroy');
        Route::get('/{id}/peserta', [\App\Http\Controllers\Admin\ParticipantsSessionController::class, 'index'])->name('sesi-peserta.index');
        Route::get('/{id}/peserta/create', [\App\Http\Controllers\Admin\ParticipantsSessionController::class, 'create'])->name('sesi-peserta.create');
        Route::get('/{id}/soal', [\App\Http\Controllers\Admin\ManajemenSoalCbtController::class, 'index'])->name('sesi-soal.index');
        Route::get('/{id}/soal/create', [\App\Http\Controllers\Admin\ManajemenSoalCbtController::class, 'create'])->name('sesi-soal.create');
        Route::post('/{id}/soal-tpk/import',\App\Http\Controllers\Admin\ImportSoalTpkController::class)->name('soal-tpk.import');
        Route::get('/{session_id}/soal/{id}/edit', [\App\Http\Controllers\Admin\ManajemenSoalCbtController::class, 'edit'])->name('sesi-soal.edit');
        Route::put('/{session_id}/soal/{id}/update', [\App\Http\Controllers\Admin\ManajemenSoalCbtController::class, 'update'])->name('sesi-soal.update');
        Route::delete('/{session_id}/soal/{id}/delete', [\App\Http\Controllers\Admin\ManajemenSoalCbtController::class, 'destroy'])->name('sesi-soal.delete');
        Route::delete('/{session_id}/soal/delete-all', [\App\Http\Controllers\Admin\ManajemenSoalCbtController::class, 'destroyAll'])->name('sesi-soal.delete-all');
        });

    Route::prefix('bobot-soal')->group(function () {
        Route::get('/data-bobot-soal', [\App\Http\Controllers\Admin\BobotSoalController::class, 'index'])->name('admin.bobot-soal.index')->middleware(['role:admin']);
        Route::post('/bobot-soal', [\App\Http\Controllers\Admin\BobotSoalController::class, 'store'])->name('admin.bobot-soal.store')->middleware(['role:admin']);
        Route::get('/bobot-soal/create', [\App\Http\Controllers\Admin\BobotSoalController::class, 'create'])->name('admin.bobot-soal.create')->middleware(['role:admin']);
        Route::get('/bobot-soal/{id}', [\App\Http\Controllers\Admin\BobotSoalController::class, 'show'])->name('admin.bobot-soal.show')->middleware(['role:admin']);
        Route::get('/bobot-soal/{id}/edit', [App\Http\Controllers\Admin\BobotSoalController::class, 'edit'])->name('admin.bobot-soal.edit')->middleware(['role:admin']);
        Route::put('/bobot-soal/{id}', [App\Http\Controllers\Admin\BobotSoalController::class, 'update'])->name('admin.bobot-soal.update')->middleware(['role:admin']);
        Route::delete('/bobot-soal/{id}', [App\Http\Controllers\Admin\BobotSoalController::class, 'destroy'])->name('admin.bobot-soal.destroy')->middleware(['role:admin']);
        Route::post('admin/bobot-soal/storeTemporary', [App\Http\Controllers\Admin\BobotSoalController::class, 'storeTemporary'])->name('admin.bobot-soal.storeTemporary')->middleware(['role:admin']);
        Route::delete('admin/bobot-soal/removeTemporary/{index}', [App\Http\Controllers\Admin\BobotSoalController::class, 'removeTemporary'])->name('admin.bobot-soal.removeTemporary')->middleware(['role:admin']);
        Route::delete('/admin/bobot-soal/deleteRow/{id}', [App\Http\Controllers\Admin\BobotSoalController::class, 'deleteRow'])->name('admin.bobot-soal.deleteRow')->middleware(['role:admin']);
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
       });


    Route::get('/hasil-lomba-tpk', HasilLombaTpkController::class)->name('hasil-tpk');

})->middleware(['role:admin']);
//Peserta
Route::prefix('peserta')->middleware(['role:peserta'])->group(function () {
    Route::get('/edit-profile', [App\Http\Controllers\Peserta\EditProfilePesertaController::class, 'editProfilePeserta'])->name('editProfilePeserta')->middleware(['role:peserta']);
    Route::put('/update-profile', [App\Http\Controllers\Peserta\EditProfilePesertaController::class, 'updateProfilePeserta'])->name('updateProfilePeserta')->middleware(['role:peserta']);
    // Dashboard peserta
    Route::get('/dashboard', [\App\Http\Controllers\Peserta\DashboardController::class, 'index'])->name('peserta.dashboard');
    
    // Computer Based Test
    Route::get('/tes-pengetahuan-kepramukaan', [\App\Http\Controllers\Peserta\SesiLombaTpkController::class, 'index'])->name('peserta.sesi-tpk.index');
    Route::post('/cbt/{session_id}/token', \App\Http\Controllers\Peserta\AttemptTokenController::class )->name('token.cbt');
    Route::get('/cbt/{session_id}/start/{question_number}', \App\Http\Controllers\Peserta\StartCbtController::class )->name('start.cbt');
    Route::post('/cbt/{session_id}/{question_number}/answer', \App\Http\Controllers\Peserta\SaveAnswerCbtController::class)->name('answer.cbt');
    Route::get('/cbt/{session_id}/finish', \App\Http\Controllers\Peserta\EndCbtController::class)->name('end.cbt');
    Route::get('/cbt/{session_id}/review', \App\Http\Controllers\Peserta\ReviewCbtController::class)->name('review.cbt');
});
//Pembina
Route::prefix('pembina')->group(function () {
    Route::get('/dashboard', function () {
        return view('pembina.dashboard');
    })->name('pembina.dashboard')->middleware(['role:pembina']);
    Route::get('/edit-profile-pembina', [App\Http\Controllers\Pembina\EditProfilePembinaController::class, 'editProfilePembina'])->name('editProfilePembina')->middleware(['role:pembina']);
    Route::put('/update-profile-pembina', [App\Http\Controllers\Pembina\EditProfilePembinaController::class, 'updateProfilePembina'])->name('updateProfilePembina')->middleware(['role:pembina']);
    Route::get('/lihat-anggota', [App\Http\Controllers\Pembina\LihatAnggotaController::class, 'index'])->name('pembina.lihat-anggota')->middleware(['role:pembina']);
    // Route untuk upload lomba
    Route::get('/upload-lombas', [App\Http\Controllers\Pembina\UploadLombaController::class, 'upload_lombas'])->name('upload_lombas.form')->middleware(['role:pembina']);
    Route::post('/upload-lombas/store', [App\Http\Controllers\Pembina\UploadLombaController::class, 'store'])->name('upload_lombas.store')->middleware(['role:pembina']);
    Route::delete('/upload-lombas/{id}', [App\Http\Controllers\Pembina\UploadLombaController::class, 'destroy'])->name('upload_lombas.destroy')->middleware(['role:pembina']);
    Route::get('/upload-lombas/edit/{id}', [App\Http\Controllers\Pembina\UploadLombaController::class, 'edit'])->name('upload_lombas.edit')->middleware(['role:pembina']);
    Route::put('/upload-lombas/update/{id}', [App\Http\Controllers\Pembina\UploadLombaController::class, 'update'])->name('upload_lombas.update')->middleware(['role:pembina']);
    Route::post('/lomba-foto-vidio/store', [\App\Http\Controllers\Pembina\LombaFotoVidioController::class, 'store'])->name('lomba_foto_vidio.store')->middleware(['role:pembina']);
    Route::get('/lomba-foto-vidio/{file}', [\App\Http\Controllers\Pembina\LombaFotoVidioController::class, 'showFile'])->name('lomba_foto_vidio.showFile')->middleware(['role:pembina']);
    Route::delete('/lomba-foto-vidio/{id}', [\App\Http\Controllers\Pembina\LombaFotoVidioController::class, 'destroy'])->name('lomba_foto_vidio.destroy')->middleware(['role:pembina']);
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
    Route::get('/regu/{jenisKelamin}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getRegu'])->name('getRegu');
})->middleware(['role:pembina']);
//Juri
Route::prefix('juri')->group(function () {
    Route::get('/dashboard', function () {
        $finalisasis = Finalisasi::with('pembina')->get();
        return view('juri.dashboard', compact('finalisasis'));
    })->name('juri.dashboard')->middleware(['role:juri']);
    Route::get('/profil', [App\Http\Controllers\Pembina\RegistrasiController::class, 'registrasi'])->name('profil.juri')->middleware(['role:juri']);
    Route::get('/edit-profile-juri', [App\Http\Controllers\Juri\EditProfileJuriController::class, 'editProfileJuri'])->name('editProfileJuri')->middleware(['role:juri']);
    Route::put('/update-profile-juri', [App\Http\Controllers\Juri\EditProfileJuriController::class, 'updateProfileJuri'])->name('updateProfileJuri')->middleware(['role:juri']);
    Route::resource('/penilaian-karikatur', \App\Http\Controllers\Juri\PenilaianKarikaturController::class)->middleware(['role:juri']);
    Route::get('/penilaian-karikatur/create', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'createForm'])->name('penilaian-karikatur.create')->middleware(['role:juri']);
    Route::post('/penilaian-karikatur', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'store'])->name('penilaian-karikatur.store')->middleware(['role:juri']);
    Route::get('/penilaian-karikatur/{id}', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'edit'])->name('penilaian-karikatur.edit')->middleware(['role:juri']);
    Route::put('/penilaian-karikatur/{id}', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'update'])->name('penilaian-karikatur.update')->middleware(['role:juri']);
    Route::delete('/penilaian-karikatur/{id}', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'destroy'])->name('penilaian-karikatur.destroy')->middleware(['role:juri']);

    Route::resource('/penilaian-pionering', \App\Http\Controllers\Juri\PenilaianPioneringController::class)->middleware(['role:juri']);
    Route::get('/penilaian-pionering/create', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'createForm'])->name('penilaian-pionering.create')->middleware(['role:juri']);
    Route::post('/penilaian-pionering', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'store'])->name('penilaian-pionering.store')->middleware(['role:juri']);
    Route::get('/penilaian-pionering/{id}', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'edit'])->name('penilaian-pionering.edit')->middleware(['role:juri']);
    Route::put('/penilaian-pionering/{id}', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'update'])->name('penilaian-pionering.update')->middleware(['role:juri']);
    Route::delete('/penilaian-pionering/{id}', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'destroy'])->name('penilaian-pionering.destroy')->middleware(['role:juri']);
    Route::match(['get', 'post'], '/juri', [\App\Http\Controllers\Juri\ProfilJuriController::class, 'createOrUpdate'])->name('juri.profil_juri')->middleware(['role:juri']);
    
    Route::post('/filter-mata-lomba', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'filterMataLomba'])->name('mata-lomba.filter')->middleware(['role:juri']);
    Route::post('/filter-nama-regu', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'filterNamaRegu'])->name('nama-regu.filter')->middleware(['role:juri']);
    Route::post('/filter-peserta', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'filterPeserta'])->name('peserta.filter')->middleware(['role:juri']);
    Route::post('/filter-kriteria', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'filterKriteria'])->name('kriteria.filter')->middleware(['role:juri']);

    Route::post('/filter-mata-lomba', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'filterMataLomba'])->name('mata-lomba.filter')->middleware(['role:juri']);
    Route::post('/filter-nama-regu', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'filterNamaRegu'])->name('nama-regu.filter')->middleware(['role:juri']);
    Route::post('/filter-peserta', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'filterPeserta'])->name('peserta.filter')->middleware(['role:juri']);
    Route::post('/filter-kriteria', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'filterKriteria'])->name('kriteria.filter')->middleware(['role:juri']);
    Route::get('/regu/{pangkalan_id}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getReguPangkalan'])->name('getReguPangkalan');
    Route::get('/peserta/{regu_id}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getPesertaRegu'])->name('getPesertaRegu');
})->middleware(['role:juri']);

