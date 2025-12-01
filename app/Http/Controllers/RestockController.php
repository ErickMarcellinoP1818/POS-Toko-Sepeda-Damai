<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Restock;
use App\Models\Supplier;
use App\Models\Produk;
use App\Models\DetailPembelian;
use App\Models\DetilProduk;
use App\Models\Varian;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class RestockController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $date = $request->filterDate;
        $dateDone = $request->filterDateDone;
        $produk = Produk::all();
        

        $restock = Restock::when($search, function($query, $search){
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('Kode', 'like', '%' . $search . '%')
                  ->orWhereHas('kategori', function($q) use ($search) {
                      $q->where('nama', 'like', '%' . $search . '%');
                  });
        })
        ->when($date, function($query) use ($date) {
            $query->whereDate('tanggal', '>=', $date);
        })
        ->when($dateDone, function($query) use ($dateDone) {
            $query->whereDate('tanggal', '<=', $dateDone);
        })
        ->orderby('tanggal', 'desc')
        ->get();

        $total = $restock->sum('total');
        return view('restock.index', compact('restock', 'produk', 'total'));
    }

    public function rincian()
    {
        Carbon::setLocale('id');
        $date = Carbon::now()->translatedFormat('l, d F Y');
        $produk = Produk::all();
        $beli = session()->get('beli', []);
        $supplier = Supplier::all();
        $total = 0;
        foreach($beli as $details) {
            $total += $details['harga'] * $details['jumlah'];
        }

        return view('kelolaProduk.beli', compact('produk', 'total', 'beli', 'supplier'))->with('success', 'Transaksi siap diproses.');
    }

   public function addToBuy()
    {
        $beli = session()->get('beli',[]);
        $produk = Produk::where('status', 'aktif')
        ->with('varian')
        ->select('id', 'nama', 'harga')
        ->get();
        return view('kelolaProduk.modalBeli', compact('produk', 'beli'));
    }

    public function editModal($id)
    {
        $beli = session()->get('beli', []);
        $editItem = collect($beli)->firstWhere('id_produk', $id);
        $produk = Produk::where('status', 'aktif')->get();

        return view('kelolaProduk.modalBeli', compact('beli', 'produk', 'editItem'));
    }

    public function create()
    {
        $supplier = Supplier::all();
        $produk = Produk::where('status', 'aktif')->get();
        return view('restock.create', compact('supplier', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_supplier' => 'required',
        ]);

        try {
            $beli = session()->get('beli');

            if (!$beli || count($beli) === 0) {
                return redirect()->back()->with('error', 'Tidak ada item pembelian untuk disimpan.');
            }

            $total = 0;
            foreach ($beli as $item) {
                $total += $item['harga'] * $item['jumlah'];
            }

            \DB::beginTransaction();
            $tempo = empty($request->tempo) ? null : $request->tempo;
            $tbayar = empty($request->tempo) ? now() : null;
            $metod = empty($request->tempo) ? 'termin' : 'tempo';

            $restock = Restock::create([
                'id_supplier' => $request->id_supplier,
                'tanggal' => Carbon::now(),
                'no_trans' => 'BUY-' . date('Ymd') . '-' . str_pad(Restock::count() + 1, 3, '0', STR_PAD_LEFT),
                'total' => $total,
                'tbayar' => $tbayar,
                'tanggal_tempo' => $tempo,
                'metode' => $metod
            ]);

            foreach ($beli as $key => $item) {

                DetailPembelian::create([
                    'id_pembelian' => $restock->id,
                    'id_produk' => $item['id_produk'],
                    'id_varian' => $item['id_varian'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'],
                    'total' => $item['jumlah'] * $item['harga'],
                ]);

                DetilProduk::create([
                    'id_produk' => $item['id_produk'],
                    'id_varian' => $item['id_varian'],
                    'id_supplier' => $request->id_supplier,
                    'stok' => $item['jumlah'],
                    'harga' => $item['harga'],
                ]);
            }

            \DB::commit();
            session()->forget('beli');

            return redirect()->route('rincianbeli')
                ->with('success', 'Berhasil menyimpan pembelian.');
        } catch (Exception $e) {
            \DB::rollBack();
            return redirect()->route('rincianbeli')
                ->with('error', 'Gagal menambahkan data pembelian: ' . $e->getMessage());
        }
    }

    public function addPembelian(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'jumlah' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        $idProduk = $request->input('id_produk');
        $idSupplier = $request->input('id_supplier');
        $jumlah = $request->input('jumlah');
        $harga = $request->input('harga');

        $produk = Produk::find($idProduk);
        $arr = session()->get('beli', []);

        $key = uniqid('item_');

        $arr[$key] = [
            "id_produk" => $request->id_produk,
            "nama" => Produk::find($request->id_produk)->nama,
            "id_varian" => null,
            "nama_varian" => null,
            "jumlah" => $jumlah,
            "harga" => $harga,
        ];

        session()->put('beli', $arr);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke daftar pembelian');
    }

  public function deletePembelian(Request $request)
    {
        $id = $request->id;

        if ($id) {
            $beli = session()->get('beli', []);

            if (isset($beli[$id])) {
                unset($beli[$id]);
                session()->put('beli', $beli);
            }

            $total = 0;
            foreach (session()->get('beli', []) as $details) {
                $total += $details['harga'] * $details['jumlah'];
            }

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus.',
                'beli' => session()->get('beli', []),
                'total' => number_format($total, 0, ',', '.')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'ID tidak ditemukan.'
        ]);
    }
    public function updatePembelian(Request $request, $key)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        $beli = session()->get('beli', []);

        if (isset($beli[$key])) {
            $beli[$key]['jumlah'] = $request->jumlah;
            $beli[$key]['harga'] = $request->harga;
            session()->put('beli', $beli);
            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    public function edit($id)
    {
        $restock = Restock::find($id);
        $supplier = Supplier::all();
        $produk = Produk::all();
        return view('restock.edit', compact('restock', 'supplier', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $restock = Restock::find($id);
        $restock->update([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total' => $request->total,
            'id_supplier' => $request->id_supplier,
            'tanggal' => $request->tanggal,
        ]);
        return redirect()->route('restock.index')->with('success', 'Berhasil mengubah data restock');
    }

    public function destroy($id)
    {
        try{
            $restock = Restock::find($id);
            $restock->delete();
            return redirect()->route('restock.index')->with('success', 'Berhasil menghapus data restock');
        }catch(Exception $e){
            return redirect()->route('restock.index')->with('error', 'Gagal menghapus data restock');
        }
    }

    public function option()
    {
        return view('laporan.modalOptionPrint');
    }

    public function print(Request $request)
    {
        $tanggalM = $request->filterDate1;
        $tanggalD = $request->filterDateDone1;

        $detail = $request->has('detail');

        $pembelian = Restock::with('DetailPembelian.produk', 'supplier')
        ->when($tanggalM, function($query) use ($tanggalM) {
            $query->whereDate('tanggal', '>=', $tanggalM);
        })
        ->when($tanggalD, function($query) use($tanggalD) {
            $query->whereDate('tanggal', '<=', $tanggalD);
        })
        ->orderBy('tanggal', 'asc')
        ->get();
        
        $totalAll = $pembelian->sum('total');
        
        $pdf = Pdf::loadView('laporan.hPembelian', compact('pembelian', 'totalAll', 'tanggalM', 'tanggalD', 'detail'));
        return $pdf->download("pembelian.pdf");
    }

    public function detail($id)
    {
        try{
            $pembelian = Restock::with(['DetailPembelian.produk'])->findOrFail($id);
            return view('restock.detail', compact('pembelian'));
        }catch(Exception $e){
            return response()->view('errors.ajax', [
                'error' => 'Failed to load details',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function updateVarian(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'varian_id' => 'required|exists:varian,id'
        ]);

        $beli = session()->get('beli', []);
        
        if (isset($beli[$request->item_id])) {
            $varian = Varian::find($request->varian_id);
            
            $beli[$request->item_id]['id_varian'] = $varian->id;
            $beli[$request->item_id]['nama_varian'] = $varian->nama_varian;
            
            session()->put('beli', $beli);
            
            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json(['success' => false], 404);
    }

    public function tempo(Request $request)
    {
        $search = $request->search;
        $produk = Produk::all();

        $restock = Restock::query()
                ->whereNull('tbayar') 
                ->when($search, function($query, $search){
                    $query->where(function($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%')
                        ->orWhere('Kode', 'like', '%' . $search . '%')
                        ->orWhereHas('kategori', function($q2) use ($search) {
                            $q2->where('nama', 'like', '%' . $search . '%');
                        });
                    });
                })
        ->orderby('tanggal_tempo', 'asc')
        ->get();

        $total = $restock->sum('total');
        return view('restock.tempo', compact('restock', 'produk', 'total'));
    }

    public function bayar($id)
    {
        $bayar = Restock::findOrFail($id);

        $bayar->tbayar = now();
        $bayar->save();

        return redirect()->route('tempo')->with('success','Pembayaran Dikonfirmasi');
    }

    public function coTempo()
    {
        return view('kelolaProduk.modalTempo');
    }
}
