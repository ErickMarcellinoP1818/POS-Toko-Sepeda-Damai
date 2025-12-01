<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Exception;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
        ]);

        try{
                Kategori::create([
                'nama' => $request->input('nama'),
            ]);
            return redirect()->route('kategori.index')->with('success', 'Berhasil menambahkan kategori');
        } catch(Exception $e){
            return redirect()->route('kategori.index')->with('error', 'Gagal menambahkan kategori');
        }
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        try{
            $kategori = Kategori::find($id);
            $kategori->update([
                'nama' => $request->nama,
            ]);
            return redirect()->route('kategori.index')->with('success', 'Berhasil mengubah kategori');
        } catch(Exception $e){
            return redirect()->route('kategori.index')->with('error', 'Gagal mengubah kategori');
        }
    }

    public function destroy($id)
    {
        try{
            $kategori = Kategori::find($id);
            $kategori->delete();
            return redirect()->route('kategori.index')->with('success', 'Berhasil menghapus kategori');
        } catch(Exception $e){
            return redirect()->route('kategori.index')->with('error', 'Gagal menghapus kategori');
        }
    }
}
