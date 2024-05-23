<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function updateStok(Request $request, $id)
    {

        $stok = Stok::find($id);
        $stok->min = $request->min;
        $stok->update();
        return back()->with([
            'message' => 'Updated successfully',
        ]);
    }
}
