<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    use HasFactory;

    public function profil()
    {
        $user = auth()->user();
        return view('profil', compact('user'));
    }
    public function show()
    {
        $user = auth()->user();
        return view('profil.profilD', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profil.profilD', compact('user'));
    }

    public function updateFoto(Request $request, $id)
    {
        $request->validate([
            'foto'=> 'image|mimes:jpeg,png,jpg,gif',
        ]);

        try {
            $user = User::find($id);
            if (!$user) {
                return redirect()->route('/')->with('error', 'User not found.');
            }

            if ($request->hasFile('foto')) {
                if ($user->foto) {
                    \Storage::disk('public')->delete($user->foto);
                }

                $image = $request->file('foto')->store('user', 'public');
                $user->foto = $image; 
            }

            $user->save(); 

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('user.show', $user->id)->with('success', 'Berhasil mengubah data!');
    }
    public function update1(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $user = User::find($id);
            if (!$user) {
                return redirect()->route('/')->with('error', 'User not found.');
            }

            $user->name = $request->name;
            $user->save(); 

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('profil', $user->id)->with('success', 'Berhasil mengubah data!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $user = User::find($id);
            if (!$user) {
                return redirect()->route('/')->with('error', 'User not found.');
            }

            
            $user->name = $request->name;
            $user->save(); 

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('user.show', $user->id)->with('success', 'Berhasil mengubah data!');
    }

    public function hapusFoto($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return redirect()->route('/')->with('error', 'User not found.');
            }

            if ($user->foto) {
                \Storage::disk('public')->delete($user->foto);
                $user->foto = null; 
                $user->save();
            }

            return redirect()->back()->with('success', 'Foto berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function CHPWpage()
    {
        $user = auth()->user();
        return view('password.passwordch', compact('user'));
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'OldPassword' => 'required',
                'password' => 'required|min:8',
            ]);

            $user = auth()->user();

            if (!password_verify($request->OldPassword, $user->password)) {
                return redirect()->back()->with('error', 'Password lama salah.');
            }

            if ($request->OldPassword === $request->password) {
                return redirect()->back()->with('error', 'Password baru tidak boleh sama dengan yang lama.');
            }

            if ($request->password !== $request->passwordNew) {
                return redirect()->back()->with('error', 'Konfirmasi password tidak cocok.');
            }

            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Password berhasil diubah!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    
}
