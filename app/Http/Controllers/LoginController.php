<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use hash;
class LoginController extends Controller
{
    //
    public function index(){
        return view('pages/login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) 
        {
            $request->session()->regenerate();
            return redirect('/profil')->with('flash-message', 'Login sukses!');
        }
        else
        {
            return redirect()->back()->withErrors(['username' => 'Login gagal, username atau password salah!'])->onlyInput('username');
        }
    }

    public function logout()
    {
            Auth::logout();
            return redirect('/login')->with('logout', 'Log Out sukses!');
    }
}
