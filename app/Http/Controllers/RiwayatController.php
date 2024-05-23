<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all();
        $completedCount = Jadwal::where('status', 'selesai')->count();
        $percentage = $completedCount > 0 ? ($completedCount / optional($jadwal)->count()) * 100 : 0;

        // Mendapatkan tanggal hari ini menggunakan Carbon
        $today = Carbon::today()->toDateString();

        // Mengambil jadwal yang tanggalnya hari ini dan statusnya selesai
        $jadwalHariIni = Jadwal::whereDate('tanggal', $today)->get();
        $jadwalSelesai = Jadwal::where('status', 'selesai')->get();
        $jadwaCompleted = Jadwal::whereDate('tanggal', $today)->where('status', 'selesai')->count();
        $percentageTerlaksana = $jadwaCompleted > 0 ? ($jadwaCompleted / optional($jadwalHariIni)->count()) * 100 : 0;

        $percentageJadwal = optional($jadwalHariIni)->count() > 0 ? (optional($jadwalHariIni)->count() / optional($jadwal)->count()) * 100 : 0;
        return view('kontrol.riwayat.index', compact('jadwal', 'completedCount', 'percentage', 'jadwalHariIni',
        'percentageTerlaksana', 'percentageJadwal', 'jadwalSelesai'));
    }
}
