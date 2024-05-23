<?php

namespace App\Http\Controllers;

use App\Models\Pakan;
use App\Models\Stok;
use Illuminate\Http\Request;

class PemantauanController extends Controller
{
    public function index()
    {
        $pakan = Pakan::orderBy('tanggal', 'desc')->get();
        $stok = Stok::find(1);
        $percentage = isset($stok['persentase']) ? intval($stok['persentase']) : 0;
        return view('pemantauan.index', compact('pakan', 'stok', 'percentage'));
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        Pakan::create([
            'pakan' => $request->pakan,
            'tanggal' => date('Y-m-d H:i:s'),
        ]);

        return back()->with([
            'message' => 'Add data successfully',
        ]);
    }

    public function destroy($id)
    {
        $pakan = Pakan::find($id);
        $pakan->delete();

        return back()->with([
            'message' => 'Deleted successfully',
        ]);
    }
}
