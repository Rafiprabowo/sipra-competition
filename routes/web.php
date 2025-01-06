<?php

use App\Exports\HasilLombaSms;
use App\Exports\HasilLombaTpk;
use App\Http\Controllers\Admin\JuriController;
use App\Http\Controllers\Admin\KelolaSymbolSmsController;
use App\Http\Controllers\Admin\SmsQuestionSmsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HasilLombaSmsController;
use App\Http\Controllers\HasilLombaTpkController;
use App\Models\Finalisasi;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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
Route::get('/register', function () {return view('auth.register');})->name('register');
Route::post('/register', \App\Http\Controllers\Auth\RegisterController::class)->name('register.attempt');
Route::post('/logout', \App\Http\Controllers\Auth\LogoutController::class)->name('logout');

Route::get('/download-template/{templateId}', [\App\Http\Controllers\Admin\TemplateDokumenController::class, 'downloadTemplate'])->name('downloadTemplate');

Route::get('/view-file/{fileName}', [\App\Http\Controllers\Admin\TemplateDokumenController::class, 'viewFile'])->name('viewFile');

//Admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        $finalisasis = \App\Models\Finalisasi::with('pembina.upload_dokumen')->get();
        return view('admin.dashboard', compact('finalisasis'));
    })->name('admin.dashboard');
    Route::get('/admin/edit-profile-admin', [App\Http\Controllers\Admin\EditProfileAdminController::class, 'editProfileAdmin'])->name('editProfileAdmin');
    Route::put('/admin/update-profile-admin', [App\Http\Controllers\Admin\EditProfileAdminController::class, 'updateProfileAdmin'])->name('updateProfileAdmin');
    Route::resource('users', UserController::class);
    Route::post('/finalisasi/{id}/approve', [\App\Http\Controllers\Admin\FinalisasiController::class, 'approve'])->name('finalisasi.approve');
    Route::post('/finalisasi/{id}/reject', [\App\Http\Controllers\Admin\FinalisasiController::class, 'reject'])->name('finalisasi.reject');
    Route::get('/finalisasi/{id}/edit', [\App\Http\Controllers\Admin\FinalisasiController::class, 'edit'])->name('finalisasi.edit');
    Route::put('/finalisasi/{id}/update', [\App\Http\Controllers\Admin\FinalisasiController::class, 'update'])->name('finalisasi.update');
    Route::get('/view-file/{file}', [\App\Http\Controllers\Admin\FinalisasiController::class, 'view'])->name('viewFile');

    Route::get('/juri/export', [App\Http\Controllers\Admin\JuriController::class, 'export'])->name('juri.export');

    Route::post('/upload-template', [\App\Http\Controllers\Admin\HasilNilaiPioneringController::class, 'uploadTemplate'])->name('uploadTemplate');
    Route::get('/export-pdf', [\App\Http\Controllers\Admin\HasilNilaiPioneringController::class, 'exportPDF'])->name('exportPDF');
    Route::get('/export-excel', [\App\Http\Controllers\Admin\HasilNilaiPioneringController::class, 'exportExcel'])->name('exportExcel');

    Route::post('/upload-template-karikatur', [\App\Http\Controllers\Admin\HasilNilaiKarikaturController::class, 'uploadTemplateKarikatur'])->name('uploadTemplateKarikatur');
    Route::get('/export-pdf-karikatur', [\App\Http\Controllers\Admin\HasilNilaiKarikaturController::class, 'exportPDFKarikatur'])->name('exportPDFKarikatur');
    Route::get('/export-excel-karikatur', [\App\Http\Controllers\Admin\HasilNilaiKarikaturController::class, 'exportExcelKarikatur'])->name('exportExcelKarikatur');

    Route::post('/upload-template-duta-logika', [\App\Http\Controllers\Admin\HasilNilaiDutaLogikaController::class, 'uploadTemplateDutaLogika'])->name('uploadTemplateDutaLogika');
    Route::get('/export-pdf-duta-logika', [\App\Http\Controllers\Admin\HasilNilaiDutaLogikaController::class, 'exportPDFDutaLogika'])->name('exportPDFDutaLogika');
    Route::get('/export-excel-duta-logika', [\App\Http\Controllers\Admin\HasilNilaiDutaLogikaController::class, 'exportExcelDutaLogika'])->name('exportExcelDutaLogika');

    Route::post('/upload-template-lkfbb', [\App\Http\Controllers\Admin\HasilNilaiLkfbbController::class, 'uploadTemplateLkfbb'])->name('uploadTemplateLkfbb');
    Route::get('/export-pdf-lkfbb', [\App\Http\Controllers\Admin\HasilNilaiLkfbbController::class, 'exportPDFLkfbb'])->name('exportPDFLkfbb');
    Route::get('/export-excel-lkfbb', [\App\Http\Controllers\Admin\HasilNilaiLkfbbController::class, 'exportExcelLkfbb'])->name('exportExcelLkfbb');

    Route::post('/upload-template-foto', [\App\Http\Controllers\Admin\HasilNilaiFotoController::class, 'uploadTemplateFoto'])->name('uploadTemplateFoto');
    Route::get('/export-pdf-foto', [\App\Http\Controllers\Admin\HasilNilaiFotoController::class, 'exportPDFFoto'])->name('exportPDFFoto');
    Route::get('/export-excel-foto', [\App\Http\Controllers\Admin\HasilNilaiFotoController::class, 'exportExcelFoto'])->name('exportExcelFoto');

    Route::post('/upload-template-vidio', [\App\Http\Controllers\Admin\HasilNilaiVidioController::class, 'uploadTemplateVidio'])->name('uploadTemplateVidio');
    Route::get('/export-pdf-vidio', [\App\Http\Controllers\Admin\HasilNilaiVidioController::class, 'exportPDFVidio'])->name('exportPDFVidio');
    Route::get('/export-excel-vidio', [\App\Http\Controllers\Admin\HasilNilaiVidioController::class, 'exportExcelVidio'])->name('exportExcelVidio');

    // Route::resource('verif_dokumen', \App\Http\Controllers\DashboardController::class);
    Route::resource('dokumen', \App\Http\Controllers\Admin\TemplateDokumenController::class);
    Route::get('/hasil-nilai/nilai-karikatur', [\App\Http\Controllers\Admin\HasilNilaiKarikaturController::class, 'index'])->name('admin.hasil_nilai.nilai_karikatur');
    Route::get('/hasil-nilai/nilai-pionering', [\App\Http\Controllers\Admin\HasilNilaiPioneringController::class, 'index'])->name('admin.hasil_nilai.nilai_pionering');
    Route::get('/hasil-nilai/nilai-lkfbb', [\App\Http\Controllers\Admin\HasilNilaiLkfbbController::class, 'index'])->name('admin.hasil_nilai.nilai_lkfbb');
    Route::get('/hasil-nilai/nilai-duta-logika', [\App\Http\Controllers\Admin\HasilNilaiDutaLogikaController::class, 'index'])->name('admin.hasil_nilai.nilai_duta_logika');
    Route::get('/hasil-nilai/nilai-foto', [\App\Http\Controllers\Admin\HasilNilaiFotoController::class, 'index'])->name('admin.hasil_nilai.nilai_foto');
    Route::get('/hasil-nilai/nilai-vidio', [\App\Http\Controllers\Admin\HasilNilaiVidioController::class, 'index'])->name('admin.hasil_nilai.nilai_vidio');

    Route::prefix('peserta')->group(function () {
        Route::get('/data-peserta', [\App\Http\Controllers\Admin\PesertaController::class, 'index'])->name('admin.peserta.index');
        Route::get('/peserta/{id}', [\App\Http\Controllers\Admin\PesertaController::class, 'show'])->name('admin.peserta.show');
        Route::get('/peserta/{id}/edit', [\App\Http\Controllers\Admin\PesertaController::class, 'edit'])->name('admin.peserta.edit');
        Route::put('/peserta/{id}', [\App\Http\Controllers\Admin\PesertaController::class, 'update'])->name('admin.peserta.update');
        Route::delete('/peserta/{id}', [\App\Http\Controllers\Admin\PesertaController::class, 'destroy'])->name('admin.peserta.destroy');
    });

    Route::prefix('mata-lomba')->group(function () {
        Route::get('/data-mata-lomba', [\App\Http\Controllers\Admin\MataLomba::class, 'index'])->name('admin.mata-lomba.index');
        Route::post('/mata-lomba', [\App\Http\Controllers\Admin\MataLomba::class, 'store'])->name('admin.mata-lomba.store');
        Route::get('/mata-lomba/create', [\App\Http\Controllers\Admin\MataLomba::class, 'create'])->name('admin.mata-lomba.create');
        Route::get('/mata-lomba/{id}/edit', [App\Http\Controllers\Admin\MataLomba::class, 'edit'])->name('admin.mata-lomba.edit');
        Route::get('/mata-lomba/{id}', [App\Http\Controllers\Admin\MataLomba::class, 'show'])->name('admin.mata-lomba.show');
        Route::put('/mata-lomba/{id}', [App\Http\Controllers\Admin\MataLomba::class, 'update'])->name('admin.mata-lomba.update');
        Route::delete('/mata-lomba/{id}', [App\Http\Controllers\Admin\MataLomba::class, 'destroy'])->name('admin.mata-lomba.destroy');
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
        Route::get('/{session_id}/soal/{id}/edit', [\App\Http\Controllers\Admin\ManajemenSoalCbtController::class, 'edit'])->name('sesi-soal.edit');
        Route::put('/{session_id}/soal/{id}/update', [\App\Http\Controllers\Admin\ManajemenSoalCbtController::class, 'update'])->name('sesi-soal.update');
        Route::delete('/{session_id}/soal/{id}/delete', [\App\Http\Controllers\Admin\ManajemenSoalCbtController::class, 'destroy'])->name('sesi-soal.delete');
        Route::delete('/{session_id}/soal/delete-all', [\App\Http\Controllers\Admin\ManajemenSoalCbtController::class, 'destroyAll'])->name('sesi-soal.delete-all');

        });

        Route::prefix('/pengaturan-soal')->group(function(){
            Route::get('/', [\App\Http\Controllers\Admin\PengaturanSoalCbtController::class, 'index'])->name('cbt-session-question-configurations.index');
            Route::get('/create', [\App\Http\Controllers\Admin\PengaturanSoalCbtController::class, 'create'])->name('cbt-session-question-configurations.create');
            Route::post('/', [\App\Http\Controllers\Admin\PengaturanSoalCbtController::class, 'store'])->name('cbt-session-question-configurations.store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\PengaturanSoalCbtController::class, 'edit'])->name('cbt-session-question-configurations.edit');
            Route::put('/{id}/update', [\App\Http\Controllers\Admin\PengaturanSoalCbtController::class, 'update'])->name('cbt-session-question-configurations.update');
            Route::delete('/{id}/delete', [\App\Http\Controllers\Admin\PengaturanSoalCbtController::class, 'destroy'])->name('cbt-session-question-configurations.destroy');
        });

    Route::prefix('bobot-soal')->group(function () {
        Route::get('/data-bobot-soal', [\App\Http\Controllers\Admin\BobotSoalController::class, 'index'])->name('admin.bobot-soal.index');
        Route::post('/bobot-soal', [\App\Http\Controllers\Admin\BobotSoalController::class, 'store'])->name('admin.bobot-soal.store');
        Route::get('/bobot-soal/create', [\App\Http\Controllers\Admin\BobotSoalController::class, 'create'])->name('admin.bobot-soal.create');
        Route::get('/bobot-soal/{id}', [\App\Http\Controllers\Admin\BobotSoalController::class, 'show'])->name('admin.bobot-soal.show');
        Route::get('/bobot-soal/{id}/edit', [App\Http\Controllers\Admin\BobotSoalController::class, 'edit'])->name('admin.bobot-soal.edit');
        Route::put('/bobot-soal/{id}', [App\Http\Controllers\Admin\BobotSoalController::class, 'update'])->name('admin.bobot-soal.update');
        Route::delete('/bobot-soal/{id}', [App\Http\Controllers\Admin\BobotSoalController::class, 'destroy'])->name('admin.bobot-soal.destroy');
        Route::post('admin/bobot-soal/storeTemporary', [App\Http\Controllers\Admin\BobotSoalController::class, 'storeTemporary'])->name('admin.bobot-soal.storeTemporary');
        Route::delete('admin/bobot-soal/removeTemporary/{index}', [App\Http\Controllers\Admin\BobotSoalController::class, 'removeTemporary'])->name('admin.bobot-soal.removeTemporary');
        Route::delete('/admin/bobot-soal/deleteRow/{id}', [App\Http\Controllers\Admin\BobotSoalController::class, 'deleteRow'])->name('admin.bobot-soal.deleteRow');
    });

    Route::prefix('pembina')->group(function () {
        Route::get('/data-pembina', [\App\Http\Controllers\Admin\PembinaController::class, 'index'])->name('admin.pembina.index');
        Route::get('/pembina/create', [\App\Http\Controllers\Admin\PembinaController::class, 'create'])->name('admin.pembina.create');
        Route::get('/pembina/{id}', [\App\Http\Controllers\Admin\PembinaController::class, 'show'])->name('admin.pembina.show');
        Route::post('/pembina', [\App\Http\Controllers\Admin\PembinaController::class, 'store'])->name('admin.pembina.store');
        Route::get('/pembina/{id}/edit', [\App\Http\Controllers\Admin\PembinaController::class, 'edit'])->name('admin.pembina.edit');
        Route::put('/pembina/{id}', [\App\Http\Controllers\Admin\PembinaController::class, 'update'])->name('admin.pembina.update');
        Route::delete('/pembina/{id}', [\App\Http\Controllers\Admin\PembinaController::class, 'destroy'])->name('admin.pembina.destroy');
    });

    Route::prefix('juri')->group(function () {
        Route::resource('/juri', JuriController::class);
    });
    

    Route::post('/{id}/soal-tpk/import',\App\Http\Controllers\Admin\ImportSoalTpkController::class)->name('soal-tpk.import');
    Route::post('/{id}/soal-sms/import',\App\Http\Controllers\Admin\ImportSoalSmsController::class)->name('soal-sms.import');

    Route::get('/hasil-lomba-tpk', HasilLombaTpkController::class)->name('hasil-tpk');
    Route::get('/hasil-lomba-sms', HasilLombaSmsController::class)->name('hasil-sms');

    Route::prefix('laporan')->group(function(){
        Route::get('/pdf/tes-pengetahuan-kepramukaan', \App\Http\Controllers\Admin\LaporanHasilLombaTpkController::class)->name('pdf.lomba-tpk');
        Route::get('/excel/tes-pengetahuan-kepramukaan', function(){
            return Excel::download(new HasilLombaTpk(), 'hasil_lomba_tpk.xlsx');
        })->name('excel.lomba-tpk');
        
        Route::get('/pdf/tes-semaphore-morse', \App\Http\Controllers\Admin\LaporanHasilLombaSmsController::class)->name('pdf.lomba-sms');
        Route::get('/excel/tes-semaphore-morse', function(){
            return Excel::download(new HasilLombaSms(), 'hasil_lomba_sms.xlsx');
        })->name('excel.lomba-sms');
    });

    Route::prefix('/symbols')->group(function(){
        Route::get('/', [KelolaSymbolSmsController::class, 'index'])->name('symbols.index');
        Route::get('/create', [KelolaSymbolSmsController::class, 'create'])->name('symbols.create');
        Route::post('/', [KelolaSymbolSmsController::class, 'store'])->name('symbols.store');
        Route::get('/{id}/edit', [KelolaSymbolSmsController::class, 'edit'])->name('symbols.edit');
        Route::put('/{id}/update', [KelolaSymbolSmsController::class, 'update'])->name('symbols.update');   
        Route::delete('/{id}/destroy', [KelolaSymbolSmsController::class, 'destroy'])->name('symbols.destroy');   
    });

    Route::prefix('/sms-questions')->group(function(){
        Route::get('/', [SmsQuestionSmsController::class, 'index'])->name('sms-questions.index');
        Route::get('/create', [SmsQuestionSmsController::class, 'create'])->name('sms-questions.create');
        Route::post('/', [SmsQuestionSmsController::class, 'store'])->name('sms-questions.store');
        Route::get('/{id}/edit', [SmsQuestionSmsController::class, 'edit'])->name('sms-questions.edit');
        Route::put('/{smsQuestion}/update', [SmsQuestionSmsController::class, 'update'])->name('sms-questions.update');
        Route::delete('/{smsQuestion}/destroy', [SmsQuestionSmsController::class, 'destroy'])->name('sms-questions.destroy');
        
    });

});

//Peserta
Route::prefix('peserta')->middleware(['auth', 'role:peserta'])->group(function () {
    Route::get('/edit-profile', [App\Http\Controllers\Peserta\EditProfilePesertaController::class, 'editProfilePeserta'])->name('editProfilePeserta');
    Route::put('/update-profile', [App\Http\Controllers\Peserta\EditProfilePesertaController::class, 'updateProfilePeserta'])->name('updateProfilePeserta');
    
    // Dashboard peserta
    Route::get('/dashboard', [\App\Http\Controllers\Peserta\DashboardController::class, 'index'])->name('peserta.dashboard');
    
    // Computer Based Test
    Route::get('/tes-pengetahuan-kepramukaan', [\App\Http\Controllers\Peserta\SesiLombaTpkController::class, 'index'])->name('peserta.sesi-tpk.index');

    Route::get('/tes-semaphore-morse', \App\Http\Controllers\Peserta\SesiLombaSmsController::class)->name('peserta.sesi-sms.index');
    

    Route::post('/cbt/{session_id}/token', \App\Http\Controllers\Peserta\AttemptTokenController::class )->name('token.cbt');
    Route::get('/cbt/{session_id}/start/{question_number}', \App\Http\Controllers\Peserta\StartCbtController::class )->name('start.cbt');
    Route::post('/cbt/{session_id}/{question_number}/answer', \App\Http\Controllers\Peserta\SaveAnswerCbtController::class)->name('answer.cbt');
    Route::post('/sms/save-answer', \App\Http\Controllers\Peserta\SaveSmsAnswerController::class)->name('save-sms.answer');
    Route::get('/cbt/{session_id}/finish', \App\Http\Controllers\Peserta\EndCbtController::class)->name('end.cbt');
    Route::get('/cbt/{session_id}/review', \App\Http\Controllers\Peserta\ReviewCbtController::class)->name('review.cbt');
});

//Pembina
Route::prefix('pembina')->middleware(['auth', 'role:pembina'])->group(function () {
    Route::get('/dashboard', function () {
        $finalisasis = \App\Models\Finalisasi::with('pembina.upload_dokumen')->get();
        return view('pembina.dashboard', compact('finalisasis'));
    })->name('pembina.dashboard');
    Route::get('/edit-profile-pembina', [App\Http\Controllers\Pembina\EditProfilePembinaController::class, 'editProfilePembina'])->name('editProfilePembina');
    Route::put('/update-profile-pembina', [App\Http\Controllers\Pembina\EditProfilePembinaController::class, 'updateProfilePembina'])->name('updateProfilePembina');
    Route::get('/lihat-anggota', [App\Http\Controllers\Pembina\LihatAnggotaController::class, 'index'])->name('pembina.lihat-anggota');
    // Route untuk upload lomba
    Route::get('/upload-lombas', [App\Http\Controllers\Pembina\UploadLombaController::class, 'upload_lombas'])->name('upload_lombas.form');
    Route::post('/upload-lombas/store', [App\Http\Controllers\Pembina\UploadLombaController::class, 'store'])->name('upload_lombas.store');
    Route::delete('/upload-lombas/{id}', [App\Http\Controllers\Pembina\UploadLombaController::class, 'destroy'])->name('upload_lombas.destroy');
    Route::get('/upload-lombas/edit/{id}', [App\Http\Controllers\Pembina\UploadLombaController::class, 'edit'])->name('upload_lombas.edit');
    Route::put('/upload-lombas/update/{id}', [App\Http\Controllers\Pembina\UploadLombaController::class, 'update'])->name('upload_lombas.update');
    Route::post('/lomba-foto-vidio/store', [\App\Http\Controllers\Pembina\LombaFotoVidioController::class, 'store'])->name('lomba_foto_vidio.store');
    Route::get('/lomba-foto-vidio/{file}', [\App\Http\Controllers\Pembina\LombaFotoVidioController::class, 'showFile'])->name('lomba_foto_vidio.showFile');
    Route::delete('/lomba-foto-vidio/{id}', [\App\Http\Controllers\Pembina\LombaFotoVidioController::class, 'destroy'])->name('lomba_foto_vidio.destroy');
    Route::get('/registrasi', [App\Http\Controllers\Pembina\RegistrasiController::class, 'registrasi'])->name('registrasi.form');
    Route::post('/pembina/store', [App\Http\Controllers\Pembina\RegistrasiController::class, 'storePembina'])->name('pembina.store');
    Route::put('/pembina', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'updatePembina'])->name('pembina.update');
    Route::post('/regu', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'storeRegu'])->name('regu.store');
    Route::put('/regu/{regu}/update', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'updateRegu'])->name('regu.update');
    Route::delete('/regu/{regu}/destroy', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'destroyRegu'])->name('regu.destroy');
    Route::post('/peserta/store', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'storePeserta'])->name('peserta.store');
    Route::put('/peserta/{peserta}/update', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'updatePeserta'])->name('peserta.update');
    Route::delete('/peserta/{peserta}/destroy', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'destroyPeserta'])->name('peserta.destroy');
    Route::post('/dokumen-persyaratan', [\App\Http\Controllers\Pembina\RegistrasiController::class, 'storeDokumen'])->name('upload_dokumen.store');
    Route::resource('data-peserta', \App\Http\Controllers\Pembina\PesertaController::class);
    Route::post('/finalisasi', [App\Http\Controllers\Pembina\RegistrasiController::class, 'finalisasi'])->name('finalisasi');
    Route::post('/peserta/import', [\App\Http\Controllers\Pembina\PesertaController::class, 'import'])->name('peserta.import');
    Route::get('/regu/{jenisKelamin}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getRegu'])->name('getRegu');
});

//Juri
Route::prefix('juri')->middleware(['auth', 'role:juri'])->group(function () {
    Route::get('/dashboard', function () {
        $finalisasis = Finalisasi::with('pembina')->get();
        return view('juri.dashboard', compact('finalisasis'));
    })->name('juri.dashboard');
    Route::get('/profil', [App\Http\Controllers\Pembina\RegistrasiController::class, 'registrasi'])->name('profil.juri');
    Route::get('/edit-profile-juri', [App\Http\Controllers\Juri\EditProfileJuriController::class, 'editProfileJuri'])->name('editProfileJuri');
    Route::put('/update-profile-juri', [App\Http\Controllers\Juri\EditProfileJuriController::class, 'updateProfileJuri'])->name('updateProfileJuri');
    
    Route::resource('/penilaian-karikatur', \App\Http\Controllers\Juri\PenilaianKarikaturController::class);
    Route::get('/penilaian-karikatur/create', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'createForm'])->name('penilaian-karikatur.create');
    Route::post('/penilaian-karikatur', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'store'])->name('penilaian-karikatur.store');
    Route::get('/penilaian-karikatur/{id}', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'edit'])->name('penilaian-karikatur.edit');
    Route::put('/penilaian-karikatur/{id}', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'update'])->name('penilaian-karikatur.update');
    Route::delete('/penilaian-karikatur/{id}', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'destroy'])->name('penilaian-karikatur.destroy');

    Route::resource('/penilaian-pionering', \App\Http\Controllers\Juri\PenilaianPioneringController::class);
    Route::get('/penilaian-pionering/create', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'createForm'])->name('penilaian-pionering.create');
    Route::post('/penilaian-pionering', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'store'])->name('penilaian-pionering.store');
    Route::get('/penilaian-pionering/{id}', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'edit'])->name('penilaian-pionering.edit');
    Route::put('/penilaian-pionering/{id}', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'update'])->name('penilaian-pionering.update');
    Route::delete('/penilaian-pionering/{id}', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'destroy'])->name('penilaian-pionering.destroy');
    Route::match(['get', 'post'], '/juri', [\App\Http\Controllers\Juri\ProfilJuriController::class, 'createOrUpdate'])->name('juri.profil_juri');
    
    Route::resource('/penilaian-duta-logika', \App\Http\Controllers\Juri\PenilaianDutaLogikaController::class);
    Route::get('/penilaian-duta-logika/create', [App\Http\Controllers\Juri\PenilaianDutaLogikaController::class, 'createForm'])->name('penilaian-duta-logika.create');
    Route::post('/penilaian-duta-logika', [App\Http\Controllers\Juri\PenilaianDutaLogikaController::class, 'store'])->name('penilaian-duta-logika.store');
    Route::get('/penilaian-duta-logika/{id}', [App\Http\Controllers\Juri\PenilaianDutaLogikaController::class, 'edit'])->name('penilaian-duta-logika.edit');
    Route::put('/penilaian-duta-logika/{id}', [App\Http\Controllers\Juri\PenilaianDutaLogikaController::class, 'update'])->name('penilaian-duta-logika.update');
    Route::delete('/penilaian-duta-logika/{id}', [App\Http\Controllers\Juri\PenilaianDutaLogikaController::class, 'destroy'])->name('penilaian-duta-logika.destroy');

    Route::resource('/penilaian-lkfbb', \App\Http\Controllers\Juri\PenilaianLkfbbController::class);
    Route::get('/penilaian-lkfbb/create', [App\Http\Controllers\Juri\PenilaianLkfbbController::class, 'createForm'])->name('penilaian-lkfbb.create');
    Route::post('/penilaian-lkfbb', [App\Http\Controllers\Juri\PenilaianLkfbbController::class, 'store'])->name('penilaian-lkfbb.store');
    Route::get('/penilaian-lkfbb/{id}', [App\Http\Controllers\Juri\PenilaianLkfbbController::class, 'edit'])->name('penilaian-lkfbb.edit');
    Route::put('/penilaian-lkfbb/{id}', [App\Http\Controllers\Juri\PenilaianLkfbbController::class, 'update'])->name('penilaian-lkfbb.update');
    Route::delete('/penilaian-lkfbb/{id}', [App\Http\Controllers\Juri\PenilaianLkfbbController::class, 'destroy'])->name('penilaian-lkfbb.destroy');

    Route::resource('/penilaian-foto', \App\Http\Controllers\Juri\PenilaianFotoController::class);
    Route::get('/penilaian-foto/create', [App\Http\Controllers\Juri\PenilaianFotoController::class, 'createForm'])->name('penilaian-foto.create');
    Route::post('/penilaian-foto', [App\Http\Controllers\Juri\PenilaianFotoController::class, 'store'])->name('penilaian-foto.store');
    Route::get('/penilaian-foto/{id}', [App\Http\Controllers\Juri\PenilaianFotoController::class, 'edit'])->name('penilaian-foto.edit');
    Route::put('/penilaian-foto/{id}', [App\Http\Controllers\Juri\PenilaianFotoController::class, 'update'])->name('penilaian-foto.update');
    Route::delete('/penilaian-foto/{id}', [App\Http\Controllers\Juri\PenilaianFotoController::class, 'destroy'])->name('penilaian-foto.destroy');

    Route::resource('/penilaian-vidio', \App\Http\Controllers\Juri\PenilaianVidioController::class);
    Route::get('/penilaian-vidio/create', [App\Http\Controllers\Juri\PenilaianVidioController::class, 'createForm'])->name('penilaian-vidio.create');
    Route::post('/penilaian-vidio', [App\Http\Controllers\Juri\PenilaianVidioController::class, 'store'])->name('penilaian-vidio.store');
    Route::get('/penilaian-vidio/{id}', [App\Http\Controllers\Juri\PenilaianVidioController::class, 'edit'])->name('penilaian-vidio.edit');
    Route::put('/penilaian-vidio/{id}', [App\Http\Controllers\Juri\PenilaianVidioController::class, 'update'])->name('penilaian-vidio.update');
    Route::delete('/penilaian-vidio/{id}', [App\Http\Controllers\Juri\PenilaianVidioController::class, 'destroy'])->name('penilaian-vidio.destroy');

    Route::post('/filter-mata-lomba', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'filterMataLomba'])->name('mata-lomba.filter');
    Route::post('/filter-nama-regu', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'filterNamaRegu'])->name('nama-regu.filter');
    Route::post('/filter-peserta', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'filterPeserta'])->name('peserta.filter');
    Route::post('/filter-kriteria', [App\Http\Controllers\Juri\PenilaianKarikaturController::class, 'filterKriteria'])->name('kriteria.filter');

    Route::post('/filter-mata-lomba-pionering', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'filterMataLomba'])->name('mata-lomba-pionering.filter');
    Route::post('/filter-nama-regu-pionering', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'filterNamaRegu'])->name('nama-regu-pionering.filter');
    Route::post('/filter-peserta-pionering', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'filterPeserta'])->name('peserta-pionering.filter');
    Route::post('/filter-kriteria-pionering', [App\Http\Controllers\Juri\PenilaianPioneringController::class, 'filterKriteria'])->name('kriteria-pionering.filter');
    
    Route::post('/filter-mata-lomba-duta-logika', [App\Http\Controllers\Juri\PenilaianDutaLogikaController::class, 'filterMataLomba'])->name('mata-lomba-duta-logika.filter');
    Route::post('/filter-nama-regu-duta-logika', [App\Http\Controllers\Juri\PenilaianDutaLogikaController::class, 'filterNamaRegu'])->name('nama-regu-duta-logika.filter');
    Route::post('/filter-peserta-duta-logika', [App\Http\Controllers\Juri\PenilaianDutaLogikaController::class, 'filterPeserta'])->name('peserta-duta-logika.filter');
    Route::post('/filter-kriteria-duta-logika', [App\Http\Controllers\Juri\PenilaianDutaLogikaController::class, 'filterKriteria'])->name('kriteria-duta-logika.filter');

    Route::post('/filter-mata-lomba-lkfbb', [App\Http\Controllers\Juri\PenilaianLkfbbController::class, 'filterMataLomba'])->name('mata-lomba-lkfbb.filter');
    Route::post('/filter-nama-regu-lkfbb', [App\Http\Controllers\Juri\PenilaianLkfbbController::class, 'filterNamaRegu'])->name('nama-regu-lkfbb.filter');
    Route::post('/filter-peserta-lkfbb', [App\Http\Controllers\Juri\PenilaianLkfbbController::class, 'filterPeserta'])->name('peserta-lkfbb.filter');
    Route::post('/filter-kriteria-lkfbb', [App\Http\Controllers\Juri\PenilaianLkfbbController::class, 'filterKriteria'])->name('kriteria-lkfbb.filter');

    Route::post('/filter-mata-lomba-foto', [App\Http\Controllers\Juri\PenilaianFotoController::class, 'filterMataLomba'])->name('mata-lomba-foto.filter');
    Route::post('/filter-mata-lomba-vidio', [App\Http\Controllers\Juri\PenilaianVidioController::class, 'filterMataLomba'])->name('mata-lomba-vidio.filter');

    Route::get('/regu/{pangkalan_id}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getReguPangkalan'])->name('getReguPangkalan');
    Route::get('/peserta/{regu_id}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getPesertaRegu'])->name('getPesertaRegu');

    Route::get('/regu/pionering/{pangkalan_id}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getReguPangkalan2'])->name('getReguPangkalan2');
    Route::get('/peserta/pionering/{regu_id}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getPesertaRegu2'])->name('getPesertaRegu2');

    Route::get('/regu/duta_logika/{pangkalan_id}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getReguPangkalan3'])->name('getReguPangkalan3');
    Route::get('/peserta/duta_logika/{regu_id}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getPesertaRegu3'])->name('getPesertaRegu3');

    Route::get('/regu/lkfbb/{pangkalan_id}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getReguPangkalan4'])->name('getReguPangkalan4');
    Route::get('/peserta/lkfbb/{regu_id}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getPesertaRegu4'])->name('getPesertaRegu4');

    Route::get('/foto/{pembina_id}', \App\Http\Controllers\Juri\GetPembinaByIDController::class)->name('getPembinaById');
    Route::get('/vidio/{pembina_id}', \App\Http\Controllers\Juri\GetPembinaByID2Controller::class)->name('getPembinaById2');
});

