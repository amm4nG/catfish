<?php

namespace App\Http\Controllers;

use App\Models\IsValue;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeControlller extends Controller
{
    public function index()
    {
        // Mengatur timezone ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');

        // Mendapatkan tanggal dan waktu saat ini
        $currentDateTime = Carbon::now();
        // echo $currentDateTime." | ";
        // Mengambil jadwal yang terdekat dari tanggal dan waktu saat ini
        $nearestSchedule = Jadwal::selectRaw('*, CONCAT(tanggal, " ", waktu) AS combined_datetime')
            ->whereRaw('CONCAT(tanggal, " ", waktu) >= ?', [$currentDateTime->format('Y-m-d H:i:s')])
            ->orderByRaw('CONCAT(tanggal, " ", waktu) ASC')
            ->first();
        $timeDiff = 'No nearest schedule found';
        $scheduleDateTime = '';
        if ($nearestSchedule) {
            // Mengonversi jadwal waktu dan tanggal ke objek Carbon
            $scheduleDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $nearestSchedule->combined_datetime);
            // Menghitung selisih waktu antara jadwal terdekat dengan waktu saat ini
            $timeDiff = $currentDateTime->diff($scheduleDateTime);
        }
        return view('home', compact('timeDiff', 'scheduleDateTime'));
    }

    // public function updateStatus(Request $request)
    // {
    // // Mengambil baris pertama dari tabel is_values
    // $status = DB::table('isvalue')->first();

    // // Periksa apakah baris ditemukan
    // if ($status) {
    // // Tentukan nilai status baru
    // $newStatus = $request->status == 0 ? 1 : 0;

    // // Update status
    // DB::table('isvalue')->update(['status' => $newStatus]);
    // }

    // // Kembali ke halaman sebelumnya
    // return back();
    // }
}
