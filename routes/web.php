<?php

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
Route::get('/', function () {return redirect()->route('login');});
Route::get('/login', function () {return view('auth.login');})->name('login');
Route::post('/login', \App\Http\Controllers\Auth\LoginController::class)->name('login.attempt');
Route::post('/logout', \App\Http\Controllers\Auth\LogoutController::class)->name('logout');

Route::prefix('admin')->group(function(){
Route::get('/dashboard', function(){return view('admin.dashboard');})->name('admin.dashboard');
Route::prefix('peserta')->group(function(){
    Route::get('/data-peserta', [\App\Http\Controllers\Admin\PesertaController::class, 'index'])->name('admin.peserta.index');
    Route::get('/peserta/{id}', [\App\Http\Controllers\Admin\PesertaController::class, 'show'])->name('admin.peserta.show');
    Route::get('/peserta/{id}/edit', [\App\Http\Controllers\Admin\PesertaController::class, 'edit'])->name('admin.peserta.edit');
    Route::put('/peserta/{id}', [\App\Http\Controllers\Admin\PesertaController::class, 'update'])->name('admin.peserta.update');
    Route::delete('/peserta/{id}', [\App\Http\Controllers\Admin\PesertaController::class, 'destroy'])->name('admin.peserta.destroy');
});

Route::prefix('pembina')->group(function(){
    Route::get('/data-pembina', [\App\Http\Controllers\Admin\PembinaController::class, 'index'])->name('admin.pembina.index');
    Route::get('/pembina/create', [\App\Http\Controllers\Admin\PembinaController::class, 'create'])->name('admin.pembina.create');
    Route::get('/pembina/{id}', [\App\Http\Controllers\Admin\PembinaController::class, 'show'])->name('admin.pembina.show');
    Route::post('/pembina', [\App\Http\Controllers\Admin\PembinaController::class, 'store'])->name('admin.pembina.store');
    Route::get('/pembina/{id}/edit', [\App\Http\Controllers\Admin\PembinaController::class, 'edit'])->name('admin.pembina.edit');
    Route::put('/pembina/{id}', [\App\Http\Controllers\Admin\PembinaController::class, 'update'])->name('admin.pembina.update');
    Route::delete('/pembina/{id}', [\App\Http\Controllers\Admin\PembinaController::class, 'destroy'])->name('admin.pembina.destroy');
});
});
Route::prefix('peserta')->group(function(){
    Route::get('/dashboard',function(){return view('peserta.dashboard');})->name('peserta.dashboard');
})->middleware('role:peserta');
Route::prefix('pembina')->group(function(){
    Route::get('/dashboard',function(){return view('pembina.dashboard');})->name('pembina.dashboard');
})->middleware('role:pembina');
Route::prefix('juri')->group(function(){
    Route::get('/dashboard',function(){return view('juri.dashboard');})->name('juri.dashboard');
})->middleware('role:juri');

