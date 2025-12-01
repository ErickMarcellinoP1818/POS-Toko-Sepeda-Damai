<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetilProduk;
use App\Models\DetilNota;
use App\Models\Produk;
use App\Models\Kategori;
class ProdukHomeController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::with('varian')
        ->where('status', 'aktif')
        ->when($request->search, function($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        })
        ->when($request->category, function($query) use ($request) {
            $query->where('id_kategori', $request->category);
        })
        ->inRandomOrder()
        ->get();
        $kategori = Kategori::all();
        $detil = DetilProduk::all();

        $stok = DetilProduk::select('id_produk')
        ->selectRaw('SUM(stok) as total_stok')
        ->groupBy('id_produk')
        ->pluck('total_stok', 'id_produk');

       $laris = DetilNota::select('id_produk')
        ->selectRaw('SUM(jumlah) as laku')
        ->whereHas('nota', function($query) {
            $query->whereBetween('tanggal', [now()->subDays(30), now()]);
        })
        ->whereHas('produk', function($query){
            $query->where('status', 'aktif');   
        })
        ->with(['produk'])
        ->groupBy('id_produk')
        ->orderByDesc('laku')
        ->limit(3)
        ->get()
        ->filter(function($item) {
            return $item->produk !== null;
        });

        return view('produkPage', compact('produk', 'kategori', 'stok', 'laris'));
    }
    public function show($id)
    {
        $detilProduk = DetilProduk::where('id_produk', $id)->get();
        $produk = Produk::with(['varian' => function($q) {
            $q->where('status', 1);
        }])->findOrFail($id);;
        $kategori = Kategori::all();
        $stock = DetilProduk::where('id_produk', $id)
        ->sum('stok');

        return view('detailproduk', compact('produk', 'kategori', 'stock', 'detilProduk'));
    }
}
