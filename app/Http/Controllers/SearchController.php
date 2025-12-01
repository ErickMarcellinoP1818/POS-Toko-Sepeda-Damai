<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('search');

        $produk = Produk::where('nama', 'LIKE', "%$keyword%")
            ->orWhere('Kode', 'LIKE', "%$keyword%")
            ->get();

        $kategori = Kategori::all();

        $previousPage = url()->previous();

        if (str_contains($previousPage, 'kelolaProduk')) {
            return view('kelolaProduk.index', compact('produk', 'kategori'));
        } elseif (str_contains($previousPage, 'produkPage')) {
            return view('produkPage', compact('produk', 'kategori'));
        } else {
            return view('produkPage', compact('produk', 'kategori'));
        }
    }
}
