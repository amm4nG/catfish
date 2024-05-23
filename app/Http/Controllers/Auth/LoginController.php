<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function formLogin()
    {
        return view('auth.login');
    }

    public function validationUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only(['username', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect('home')->with([
                'message' => 'Login successfully',
            ]);
        } else {
            return back()->withErrors([
                'message' => 'Username or password invalid',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
