<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(Request $request, $id)
    {
        $profile = User::find($id);
        if ($request->has('foto')) {
            if ($profile->foto) {
                Storage::disk('public')->delete($profile->foto);
            }
            $file = $request->file('foto');
            $path = $file->store('foto', 'public');
            $profile->foto = $path;
        }
        $profile->nama = $request->nama;
        $profile->username = $request->username;
        $profile->email = $request->email;
        $profile->alamat = $request->alamat;
        $profile->update();
        return back()->with([
            'message' => 'updated profile successfully',
        ]);
    }

    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'passwordLama' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        // Cek apakah password lama sesuai
        if (!Hash::check($request->passwordLama, $user->password)) {
            return back()->withErrors(['message' => 'Password lama tidak sesuai']);
        }

        $user->password = Hash::make($request->password);
        $user->update();

        return back()->with('message', 'Password berhasil diubah');
    }
}
