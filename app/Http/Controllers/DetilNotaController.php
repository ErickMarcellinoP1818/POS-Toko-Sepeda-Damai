<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\DetilNota;
use App\Models\Produk;
use App\Models\DetilProduk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Nota;
use App\Models\User;
use App\Models\Varian;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DetilNotaController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $search = $request->search;
        $filterDate = $request->filterDate;
        $filterDateDone = $request->filterDateDone;
        
        $nota = Nota::when($search, function ($query, $search) {
            $query->where('inv_num', 'like', '%' . $search . '%')
                  ->orWhereHas('kasir', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
        })
        ->when($filterDate, function ($query) use ($filterDate) {
            $query->whereDate('tanggal', '>=', $filterDate);
        })
        ->when($filterDateDone, function ($query) use ($filterDateDone) {
            $query->whereDate('tanggal', '<=', $filterDateDone);
        })
        ->orderBy('id', 'desc')
        ->get();

        $total = $nota->sum('total');

        $detilnota = DetilNota::all();
        $produk = Produk::all();
        $user = User::all();
        return view('histori.index', compact('nota', 'detilnota', 'produk', 'user', 'total'));
    }

    public function labaRugi(Request $request)
    {
        $search = $request->search;
        $filterDate = $request->filterDate;
        $filterDateDone = $request->filterDateDone;
        
        $nota = Nota::when($search, function ($query, $search) {
            $query->where('inv_num', 'like', '%' . $search . '%')
                  ->orWhereHas('kasir', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
        })
        ->when($filterDate, function ($query) use ($filterDate) {
            $query->whereDate('tanggal', '>=', $filterDate);
        })
        ->when($filterDateDone, function ($query) use ($filterDateDone) {
            $query->whereDate('tanggal', '<=', $filterDateDone);
        })
        ->orderBy('id', 'desc')
        ->get();

        $detilnota = DetilNota::all();
        $produk = Produk::all();
        $user = User::all();
        return view('histori.labaRugi', compact('nota', 'detilnota', 'produk', 'user'));
    }

    public function detail($id)
    {
        try {
            $nota = Nota::with(['detilnota.produk', 'kasir'])->findOrFail($id);
            return view('histori.detail1', compact('nota'));
        } catch (Exception $e) {
            return response()->view('errors.ajax', [
                'error' => 'Failed to load nota details',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function detailLabaRugi($id)
    {
        try {
            $nota = Nota::with(['detilnota.produk', 'kasir'])->findOrFail($id);
            return view('histori.detail', compact('nota'));
        } catch (Exception $e) {
            return response()->view('errors.ajax', [
                'error' => 'Failed to load nota details',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function print($id)
    {
        $nota = Nota::findOrFail($id);
        $detilnota = DetilNota::where('id_nota', $id)->get();

        $pdf = Pdf::loadView('laporan.print', compact('nota', 'detilnota'));
        return $pdf->download("nota-{$nota->inv_num}.pdf");
    }

    public function create()
    {
        return view('detilnota.create');
    }

   public function addProduktoCart($id)
    {
        $varian = Varian::find($id);

        if(!$varian) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        $stok_tersedia = DetilProduk::where('id_varian', $id)
        ->sum('stok');

        $cart = session()->get('cart', []);

         if (isset($cart[$id])) {
            if ($cart[$id]['jumlah'] + 1 > $stok_tersedia) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $stok_tersedia);
            }
            $cart[$id]['jumlah']++;
        } else {
            if ($stok_tersedia < 1) {
                return redirect()->back()->with('error', 'Stok produk ini habis');
            }

            $namaProduk = $varian->produk->nama;
            
            $cart[$id] = [
                "nama" => $namaProduk,
                "varian" => $varian->nama_varian,
                "jumlah" => 1,
                "harga" => $varian->produk->harga,
                "gambar" => $varian->gambar,
                "diskon" => 0,
                "id_produk" =>$varian->id_produk
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity) {
            if($request->quantity <=0){
                return response()->json([
                    'success' => false,
                    'message' => 'Jumlah tidak valid'
                ]);
            }

            $stok_tersedia = DetilProduk::where('id_varian', $request->id)
            ->sum('stok');

            $cart = session()->get('cart');

            if($request->quantity > $stok_tersedia){
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi. Stok tersedia: ' . $stok_tersedia
                ]);
            }

            $cart[$request->id]['jumlah'] = $request->quantity;
            session()->put('cart', $cart);
            
            $total = 0;

            foreach ($cart as $details) {
                $total += $details['harga'] * $details['jumlah'];
            }


            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil diupdate',
                'cart' => $cart,
                'cart_total' => number_format($total, 0, ',', '.'),
                'stok_tersedia' => $stok_tersedia
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid request'
        ]);
    }

    public function diskonAdd(Request $request)
    {
        $request->validate([
            'cart.*.diskon' => 'required|numeric|min:0'
        ]);

        $cart = session()->get('cart');
        $totalDiskon = 0;
        $subtotal = 0;

        foreach ($request->cart as $id => $data) {
            $maxDiskon = $cart[$id]['harga'] * $cart[$id]['jumlah'];
            $diskon = min($data['diskon'], $maxDiskon);
            
            $cart[$id]['diskon'] = $diskon;
            $totalDiskon += $diskon;
            $subtotal += $cart[$id]['harga'] * $cart[$id]['jumlah'];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Berhasil update diskon');

    }



    public function deleteProduct(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            $total = 0;
            foreach (session()->get('cart', []) as $details) {
                $total += $details['harga'] * $details['jumlah'];
            }

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus',
                'cart' => session()->get('cart'),
                'cart_total' => number_format($total, 0, ',', '.')
            ]);
        }

        return response()->json(['success' => false, 'message' => 'ID produk tidak ditemukan']);
    }

    public function option()
    {
        return view('laporan.modalOptionPrint');
    }

    public function printResume(Request $request)
    {
        $tanggalM = $request->filterDate1;
        $tanggalD = $request->filterDateDone1;
        $detail = $request->has('detail');

        $penjualan = Nota::with('detilnota.produk', 'kasir')
            ->when($tanggalM, function ($query) use ($tanggalM) {
                $query->whereDate('tanggal', '>=', $tanggalM);
            })
            ->when($tanggalD, function ($query) use ($tanggalD) {
                $query->whereDate('tanggal', '<=', $tanggalD);
            })
            ->orderBy('id', 'asc')
            ->get();

        $totalAll = $penjualan->sum('total');
        $pdf = Pdf::loadView('laporan.hPenjualan', compact('penjualan', 'totalAll', 'tanggalM', 'tanggalD', 'detail'));
        return $pdf->download('penjualan-' . now()->format('Y-m-d') . '.pdf');
    }

    public function printLabarugi(Request $request)
    {
        $tanggalM = $request->filterDate1;
        $tanggalD = $request->filterDateDone1;
        $detail = $request->has('detail');

        $penjualan = Nota::with('detilnota.produk', 'kasir')
            ->when($tanggalM, function ($query) use ($tanggalM) {
                $query->whereDate('tanggal', '>=', $tanggalM);
            })
            ->when($tanggalD, function ($query) use ($tanggalD) {
                $query->whereDate('tanggal', '<=', $tanggalD);
            })
            ->orderBy('id', 'asc')
            ->get();

        $totalAll = $penjualan->sum('total');
        $pdf = Pdf::loadView('laporan.hLabaRugi', compact('penjualan', 'totalAll', 'tanggalM', 'tanggalD', 'detail'));
        return $pdf->download('LabaRugi-' . now()->format('Y-m-d') . '.pdf');
    }
}
