<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeControlller;
use App\Http\Controllers\KontrolController;
use App\Http\Controllers\PemantauanController;
use App\Http\Controllers\PencatatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\StokController;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});
Route::get('/login', [LoginController::class, 'formLogin'])
    ->name('login')
    ->middleware('guest');
Route::post('/validation/user', [LoginController::class, 'validationUser'])->name('validation.user');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [HomeControlller::class, 'index'])
    ->middleware('auth')
    ->name('home');
Route::post('/update/status', [HomeControlller::class, 'updateStatus'])
    ->name('update.status')
    ->middleware('auth');

Route::resource('kontrol', KontrolController::class)->middleware('auth');
Route::resource('riwayat', RiwayatController::class)->middleware('auth');
Route::resource('pencatatan', PencatatanController::class)->middleware('auth');
Route::resource('pemantauan', PemantauanController::class)->middleware('auth');
Route::put('stok/{id}', [StokController::class, 'updateStok'])
    ->middleware('auth')
    ->name('update.stok');
Route::resource('profile', ProfileController::class)->middleware('auth');
Route::put('change/password/{id}', [ProfileController::class, 'changePassword'])
    ->middleware('auth')
    ->name('change.password');

Route::get('get-time', function () {
    date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = Carbon::now();
    $nearestSchedule = Jadwal::selectRaw('*, CONCAT(tanggal, " ", waktu) AS combined_datetime')
        ->whereRaw('CONCAT(tanggal, " ", waktu) >= ?', [$currentDateTime->format('Y-m-d H:i:s')])
        ->orderByRaw('CONCAT(tanggal, " ", waktu) ASC')
        ->first();
    if ($nearestSchedule) {
        if ($currentDateTime == $nearestSchedule->combined_datetime) {
            $nearestSchedule->status = 'selesai';
            $nearestSchedule->update();
            return "selesai";
        }
        $scheduleDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $nearestSchedule->combined_datetime);
        $timeDiff = $currentDateTime->diff($scheduleDateTime);
        return $timeDiff->format('%H Jam, %I Menit, %S Detik');
    } else {
        return null;
    }
});
