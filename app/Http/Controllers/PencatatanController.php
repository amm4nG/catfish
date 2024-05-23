<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use Illuminate\Http\Request;

class PencatatanController extends Controller
{
    public function index()
    {
        $catatan = Catatan::all();
        return view('pencatatan.index', compact('catatan'));
    }

    public function store(Request $request)
    {
        Catatan::create([
            'waktu' => $request->waktu,
            'catatan' => $request->catatan,
        ]);
        return back()->with([
            'message' => 'Add data successfully',
        ]);
    }

    public function update(Request $request, $id)
    {
        $catatan = Catatan::find($id);
        $catatan->waktu = $request->waktu;
        $catatan->catatan = $request->catatan;
        $catatan->update();
        return back()->with([
            'message' => 'Updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $catatan = Catatan::find($id);
        $catatan->delete();
        return back()->with([
            'message' => 'Deleted successfully',
        ]);
    }
}
