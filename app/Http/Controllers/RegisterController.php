<?php

namespace App\Http\Controllers;

use App\Mail\RegisterConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function register()
    {
        return view('login');
    }

    public function actionRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $str = Str::random(100);
        $user = User::create( [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verify_key' => $str,
            'jabatan' => 'non',
        ]);

        $details = [
            'name' => $request->name,
            'website' => 'Program Toko',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => request()->getHttpHost() . '/register/verify/' . $str
        ];
        

        Mail::to($request->email)->send(new RegisterConfirmationMail($details));

        Session::flash('success', 'Silahkan cek email anda untuk verifikasi akun');
        return redirect('/login');
    }

    public function verify($verify_key)
    {
        $KeyCheck = User::select('verify_key')
            ->where('verify_key', $verify_key)
            ->exists();

        if($KeyCheck) {
            $user = User::where('verify_key', $verify_key)->update( [
                'active' => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
            ]);

        return "Akun anda berhasil diverifikasi";
        }else{
            return "Akun anda gagal diverifikasi";
        }
    }
}
