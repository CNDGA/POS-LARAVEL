<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Cek level_id user setelah berhasil login
            $userLevel = Auth::user()->level_id;

            if ($userLevel == 1) {
                return redirect('dashboard')->with('success', 'Success Login');
            } elseif ($userLevel == 2) {
                return redirect('dashboard')->with('success', 'Success Login');
            } elseif ($userLevel == 3) {
                return redirect('dashboard')->with('success', 'Success Login');
            } else {
                return back()->withErrors(['email' => 'Level user tidak dikenali'])->withInput();
            }
        } else {
            return back()->withErrors(['email' => 'Mohon cek kredensialmu'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('login');
    }
}
