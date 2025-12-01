<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;

class LoginController extends Controller
{
    public function login()
    {
        if(Auth::check()) {
            return redirect('/');
        } else {
            return view('login');
        }
    }

    public function actionLogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if(Auth::attempt($data)){
            $user = Auth::user();
            $produk = Produk::where('status', 'aktif')
            ->limit(8)
            ->get();
            

            if($user->active) {
                return view('home', compact('produk'))->with('success', 'Login berhasil!, halo '.$user->name);
            } else {
                Auth::logout();
                return redirect('/login')->with('alert', 'Akun anda belum aktif, silahkan cek email anda');
            }
        } else {
            return redirect('/login')->with('alert', 'Email atau Password salah!');
        }
    }

    public function actionLogout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Anda berhasil logout');
    }

    public function homer()
    {
        return view('home');
    }
}
