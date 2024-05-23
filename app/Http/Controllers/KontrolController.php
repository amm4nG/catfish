<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KontrolController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all();
        $completedCount = Jadwal::where('status', 'selesai')->count();
        $percentage = $completedCount > 0 ? ($completedCount / optional($jadwal)->count()) * 100 : 0;

        // Mendapatkan tanggal hari ini menggunakan Carbon
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');
        // Mengambil jadwal yang tanggalnya hari ini dan statusnya selesai
        $jadwalHariIni = Jadwal::whereDate('tanggal', $today)->get();
        // echo $jadwalHariIni->count();
        $jadwalBelumSelesai = Jadwal::where('status', 'belum')->get();
        $jadwaCompleted = Jadwal::whereDate('tanggal', $today)->where('status', 'selesai')->count();
        $percentageTerlaksana = $jadwaCompleted > 0 ? ($jadwaCompleted / optional($jadwalHariIni)->count()) * 100 : 0;

        $percentageJadwal = optional($jadwalHariIni)->count() > 0 ? (optional($jadwalHariIni)->count() / optional($jadwal)->count()) * 100 : 0;
        return view('kontrol.index', compact('jadwal', 'completedCount', 'percentage', 'jadwalHariIni', 'percentageTerlaksana', 'percentageJadwal', 'jadwalBelumSelesai'));
    }

    public function store(Request $request)
    {
        $jadwal = new Jadwal();
        $jadwal->tanggal = $request->tanggal;
        $jadwal->waktu = $request->waktu;
        $jadwal->durasi = $request->durasi;
        $jadwal->status = 'belum';
        $jadwal->save();
        return back()->with([
            'message' => 'Add data successfully',
        ]);
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->tanggal = $request->tanggal;
        $jadwal->waktu = $request->waktu;
        $jadwal->durasi = $request->durasi;
        $jadwal->status = $request->status;
        $jadwal->update();
        return back()->with([
            'message' => 'Updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();
        return back()->with([
            'message' => 'Deleted successfully',
        ]);
    }
}
