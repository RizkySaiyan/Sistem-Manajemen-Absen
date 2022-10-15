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
            return redirect('/')->with('success', 'Login sukses!');
        }
        else
        {
            return redirect()->back()->with('failed', 'Login gagal, username atau password salah!');
        }
    }
}
