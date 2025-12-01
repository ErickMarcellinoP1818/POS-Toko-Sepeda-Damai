<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Restock;
use App\Models\DetilProduk;
use App\Models\Varian;

use Exception;
use function PHPUnit\Framework\returnArgument;

class ProdukController extends Controller
{

    public function index(Request $request)
    {
        
        $produk = Produk::where('status', 'aktif')
        ->where(function($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhereHas('kategori', function($q) use ($request) {
                    $q->where('nama', 'like', '%' . $request->search . '%');
                });
        })
        ->orderBy('nama', 'asc')
        ->get();

        $stok = DetilProduk::select('id_produk')
        ->selectRaw('SUM(stok) as total_stok')
        ->groupBy('id_produk')
        ->pluck('total_stok', 'id_produk');

        

        return view('kelolaProduk.index', compact('produk', 'stok'));
    }
   
    public function create()
    {
        $kategori = Kategori::all();
        $var = session()->get('varian', []);
        $index = count($var);
        return view('kelolaProduk.create', compact('kategori', 'var'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $kategori = Kategori::all();

        $produk = Produk::where('nama', 'LIKE', "%$keyword%")
            ->orWhere('Kode', 'LIKE', "%$keyword%")
            ->orWhereHas('kategori', function ($query) use ($keyword) {
                $query->where('nama', 'LIKE', "%$keyword%");
            })
            ->orderBy('nama', 'asc')
            ->get();

        return view('produkPage', compact('produk', 'kategori'));
    }


    public function store(Request $request)
    {
        $var = session()->get('varian', []);

       

        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'id_kategori' => 'nullable|integer',
        ]);

        try {
             if(!$var){
                return redirect()->back()->with('error', 'Varian tidak boleh kosong!');
            }

            DB::beginTransaction();

            $gambarProduk = null;
            if ($request->hasFile('gambar')) {
                $gambarProduk = $request->file('gambar')->store('produk', 'public');
            } 
            elseif (!empty($var) && isset($var[0]['gambars'])) {
                $gambarVarian = $var[0]['gambars'];
                if (\Storage::disk('public')->exists($gambarVarian)) {
                    $gambarProduk = $gambarVarian;
                }
            }

            $produk = Produk::create([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'gambar' => $gambarProduk,
                'id_kategori' => $request->id_kategori,
                'deskripsi' => $request->deskripsi,
            ]);

            if (!$produk) {
                throw new \Exception('Gagal membuat produk.');
            }

            foreach ($var as $item) {
                $stok = isset($item['stok']) ? (int) $item['stok'] : 0;
                $namas = $item['namas'] ?? null;
                $gambars = $item['gambars'] ?? null;
                $harga = $item['harga'] ?? null;
                $stokm = $item['stokm'] ?? null;

                 if ($stokm < 0) {
                    $stokm = 3;
                }

                if ($gambars && !\Storage::disk('public')->exists($gambars)) {
                    \Log::warning("Varian image not found: {$gambars}");
                    $gambars = null;
                }

                $varian = Varian::create([
                    'id_produk' => $produk->id,
                    'nama_varian' => $namas,
                    'gambar' => $gambars,
                    'min_stok' => $stokm,
                ]);

                if (!$varian) {
                    throw new \Exception('Gagal membuat varian.');
                }

                if ($stok > 0) {
                    DetilProduk::create([
                        'id_produk' => $produk->id,
                        'id_varian' => $varian->id,
                        'harga' => $harga ?? 0,
                        'stok' => $stok,
                    ]);
                }

                if(!$gambars){
                    return redirect()->back()->with('error', 'Gambar varian tidak boleh kosong!');
                }
            }

            DB::commit();

            session()->forget('varian');

            return redirect()->route('produks.index')->with('success', 'Berhasil menambahkan produk');
        } catch (ValidationException $ve) {
            DB::rollBack();
            return back()->withErrors($ve->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('store produk error: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
                'session_varian' => $var,
            ]);

            return redirect()->route('produks.index')->with('error', 'Gagal menambahkan produk');
        }
    }

    public function destroy($id)

    {
        $produk = Produk::find($id);
        $varian = Varian::where('id_produk', $id)->get();
        $produk->status = 'nonaktif';
        $produk->gambar='';
        $produk->save();
        if($varian->count()){
            foreach($varian as $item){
                if($item->gambar && \Storage::disk('public')->exists($item->gambar)){
                    \Storage::disk('public')->delete($item->gambar);
                }
                $item->gambar='';
                $item->status=0;
                $item->save();
            }
        }
        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $var = session()->get('varian', []);

        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'hargaB' => 'nullable|numeric',
            'id_kategori' => 'nullable|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        try {
            DB::beginTransaction();

            $produk = Produk::find($id);
            if (!$produk) {
                return redirect()->route('produks.index')->with('error', 'Produk tidak ditemukan');
            }

            $varian = $produk->varian()->where('status', 1)->first();
            
            $produk->nama = $request->nama;
            $produk->harga = $request->harga;
            $produk->id_kategori = $request->id_kategori;
            $produk->deskripsi = $request->deskripsi;
            $produk->save();
            


            foreach ($var as $item) {
                $stok = isset($item['stok']) ? (int) $item['stok'] : 0;
                $namas = $item['namas'] ?? null;
                $gambars = $item['gambars'] ?? null;
                $harga = $item['harga'] ?? null;

                if ($gambars && !\Storage::disk('public')->exists($gambars)) {
                    \Log::warning("Varian image not found: {$gambars}");
                    $gambars = null;
                }

                $varian = Varian::create([
                    'id_produk' => $produk->id,
                    'nama_varian' => $namas,
                    'gambar' => $gambars,
                ]);

                if (!$varian) {
                    throw new \Exception('Gagal membuat varian.');
                }

                $produk->gambar = $varian ? $varian->gambar : null;
                $produk->save();

                if ($stok > 0) {
                    DetilProduk::create([
                        'id_produk' => $produk->id,
                        'id_varian' => $varian->id,
                        'harga' => $harga ?? 0,
                        'stok' => $stok,
                    ]);
                }
            }

            DB::commit();

            session()->forget('varian');

            return redirect()->route('produks.index')->with('success', 'Berhasil mengubah produk');
        } catch (ValidationException $ve) {
            DB::rollBack();
            return back()->withErrors($ve->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('update produk error: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
                'session_varian' => $var,
            ]);

            if (config('app.debug')) {
                return redirect()->back()->with('error', 'Gagal mengubah produk: '.$e->getMessage());
            }

            return redirect()->route('produks.index')->with('error', 'Gagal mengubah produk. Cek log.');
        }
    }

    public function edit($id)
    {
        $produk = Produk::with(['varian' => function($q) {
            $q->where('status', 1);
        }])->findOrFail($id);;
        $kategori = Kategori::all();
        return view('kelolaProduk.edit', compact('produk', 'kategori'));
    }

    public function deleteProduct(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Produk successfully deleted.');
        }
    }

    public function addVarian(){
        return view('kelolaProduk.modalvarian');
    }
    
    public function editVarianTemp($index){
      $var = session('varian', []);

    if (!isset($var[$index])) {
        return response('<p class="text-danger">Data tidak ditemukan.</p>', 404);
    }

    $data = $var[$index];

    return view('kelolaProduk.modalEditVarianTemp', compact('data', 'index'));

    }

    public function editVarian($id){
        $varian = Varian::findOrFail($id);
        return view('kelolaProduk.modalEditVarian', compact('varian'));
    }

    public function updateVarian(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg'
        ]);
        try
        {
            $varian = Varian::find($id);
            if(!$varian){
                return redirect()->back()->with('error', 'Varian tidak ditemukan!');
            }

            if($request->hasFile('gambar')){
                if($varian->gambar){
                    \Storage::disk('public')->delete($varian->gambar);
                }
                $imagePath = $request->file('gambar')->store('varian', 'public');
                $varian->gambar = $imagePath;
            }

            $varian->nama_varian = $request->nama;
            $varian->min_stok = $request->min_stok;
            $varian->save();
            
            $produk = $varian->produk;
            $varak = $produk->varian()->where('status', 1)->first();
            $produk->gambar = $varak ? $varak->gambar : null;
            $produk->save();
            
            DB::commit();

            return redirect()->back()->with('success', 'Berhasil update varian');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengubah varian!');
        }
    }

    public function deleteVarian($id)
    {
        $varian = Varian::find($id);
        
        if ($varian->gambar && \Storage::disk('public')->exists($varian->gambar)) {
            \Storage::disk('public')->delete($varian->gambar);
        }
        
        $varian->update([
            'status' => 0,
            'gambar' => '',
        ]);

        $varAktif = Varian::where('id_produk', $varian->id_produk)
            ->where('status', 1)
            ->first();

        $produk = $varian->produk;
        if($produk){
            $produk->update([
                'gambar' => $varAktif ? $varAktif->gambar : null,
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil menghapus varian');
    }

    public function tempVarian(Request $request)
    {
        $request->validate([
            'namas' => 'required',
            'gambars' => 'image|mimes:jpeg,png,jpg',
            'hargab' => 'required|numeric|min:0'
        ]);
        try
        {
            if ($request->hasFile('gambars')) {
                $imagePath = $request->file('gambars')->store('varian', 'public');
            } else {
                $imagePath = null;
            }

            $var = session()->get('varian', []);
            
            $var[] = [
                'namas' => $request->namas,
                'gambars' => $imagePath,
                'stok' => $request->stok,
                'harga'=> $request->hargab,
                'stokm'=> $request->stokm,
            ];

            session(['varian' => $var]);

            return redirect()->back()->with('success', 'Varian berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan varian: ' . $e->getMessage());
        }
    }

    public function updateTemp(Request $request, $index)
    {
        $request->validate([
            'namas' => 'required',
            'stok'  => 'required|integer|min:0',
            'hargab'=> 'required|numeric|min:0',
            'stokm' => 'required|integer|min:0',
            'gambars' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $var = session()->get('varian', []);

        if (!isset($var[$index])) {
            return back()->with('error', 'Varian tidak ditemukan.');
        }

        if ($request->hasFile('gambars')) {
            if (!empty($var[$index]['gambars'])) {
                \Storage::disk('public')->delete($var[$index]['gambars']);
            }
            $imagePath = $request->file('gambars')->store('varian', 'public');
        } else {
            $imagePath = $var[$index]['gambars'] ?? null;
        }

        $var[$index] = [
            'namas'  => $request->namas,
            'stok'   => $request->stok,
            'harga'  => $request->hargab,
            'stokm'  => $request->stokm,
            'gambars'=> $imagePath,
        ];

        session(['varian' => $var]);

        return back()->with('success', 'Varian berhasil diupdate');
    }

    public function deleteTemp(Request $request)
    {
        $index = $request->index;
        $var = session('varian', []);

        if (isset($var[$index])) {
            if (!empty($var[$index]['gambars'])) {
                \Storage::disk('public')->delete($var[$index]['gambars']);
            }
            
            array_splice($var, $index, 1);
            
            session(['varian' => $var]);
            
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
    
}
