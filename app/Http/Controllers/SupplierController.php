<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Exception;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::where('nama', 'like', '%' .$request->search . '%')
        ->orWhere('alamat', 'like', '%' .$request->search . '%')
        ->orWhere('telepon', 'like', '%' .$request->search. '%')
        ->orderBy('nama')->get();

        return view('supplier.index', compact('suppliers'));
    }


    public function create()
    {
        return view('supplier.create');
    }

    public function edit($id)
    {
        $suppliers = Supplier::find($id);
        return view('supplier.edit', compact('suppliers'));
    }

    public function destroy($id)
    {
        try{
            $supplier = Supplier::find($id);
            $supplier->delete();
            return redirect()->route('supplier.index')->with('success', 'Berhasil menghapus supplier');
        } catch(Exception $e){
            return redirect()->route('supplier.index')->with('error', 'Gagal menghapus supplier');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'number'=>'nullable|numeric',
        ]);

        try{
            $supplier = Supplier::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('supplier.index')->with('success', 'Berhasil menambahkan supplier');
        }catch(Exception $e){
            return redirect()->route('supplier.index')->with('error', 'Gagal menambahkan supplier');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'=>'required',
            'number'=>'numeric',
        ]);

        try{
            $supplier = Supplier::find($id);
            $supplier->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('supplier.index')->with('success', 'Berhasil mengubah supplier');
        }catch(Exception $e){
            return redirect()->route('supplier.index')->with('error', 'Gagal mengubah supplier');
        }
    }

}
