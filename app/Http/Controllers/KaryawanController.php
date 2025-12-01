<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Exception;

class KaryawanController extends Controller
{
    public function index()
    {
        $search = request()->input('search');
        $karyawan = User::Where('name', 'like', '%'. $search.  '%')->get();
        return view('karyawan.index', compact('karyawan'));
    }

    public function upjabatan(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|array',
            'jabatan.*' => 'nullable|in:admin,kasir,non'
        ]);

        try {
            foreach ($request->jabatan as $userId => $jabatan) {
                if (!empty($jabatan)) {
                    User::where('id', $userId)->update(['jabatan' => $jabatan]);
                }
            }

            return redirect()->route('karyawan.index')
                ->with('success', 'Jabatan karyawan berhasil diperbarui.');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui jabatan: '.$e->getMessage());
        }
    }
}
