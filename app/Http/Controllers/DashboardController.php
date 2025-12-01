<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Nota;
use App\Models\DetilNota;
use App\Models\DetailPembelian;
use App\Models\DetilProduk;
use App\Models\Restock;
use App\Models\Varian;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $varian = Varian::with('detilProduk', 'produk')
        ->where('status', 1)
        ->whereHas('produk', function($query){
            $query->where('status', 'aktif');
        })
        ->get()
        ->filter(function($item){
            return $item->totalStok() <= $item->min_stok;
        });

        $stok = DetilProduk::select('id_varian')
        ->selectRaw('SUM(stok) as total_stok')
        ->groupBy('id_varian')
        ->pluck('total_stok', 'id_varian');
        
        $laris = DetilNota::select('id_varian')
        ->selectRaw('SUM(jumlah) as laku')
        ->whereHas('nota', function($query) {
            $query->whereBetween('tanggal', [now()->subDays(30), now()]);
        })
        ->whereHas('varian', function($query){
            $query->where('status', '1');   
        })
        ->with(['varian'])
        ->groupBy('id_varian')
        ->orderByDesc('laku')
        ->limit(10)
        ->get()
        ->filter(function($item) {
            return $item->varian !== null;
        });

        $user = Auth::user();
        $kategori = Kategori::All();

        $currentYear = date('Y');
        $lastYear = $currentYear - 1;

        $now = now();
        $yesterday = now()->subDay();
        $lastmonth = now()->subMonth();

        $nota = Nota::whereMonth('tanggal', now()->month)
        ->whereYear('tanggal', now()->year)
        ->get();

        $notayt = Nota::whereDay('tanggal', $yesterday)
        ->whereMonth('tanggal', $yesterday->month)
        ->whereYear('tanggal', $yesterday->year)
        ->get();

        $notabl = Nota::whereMonth('tanggal', $lastmonth->month)
        ->whereYear('tanggal', $lastmonth->year)
        ->get();


        $notatd = Nota::whereDate('tanggal', now())
        ->get();


        $restock = Restock::whereMonth('tanggal', now()->month)
        ->whereYear('tanggal', now()->year)
        ->get();

        $restockbl = Restock::whereMonth('tanggal', $lastmonth->month)
        ->whereYear('tanggal', $lastmonth->year)
        ->get();

        $restocktd = Restock::whereDate('tanggal', now())
        ->get();


        $detilNota =  DetilNota::All();
        
        $detilBeli = DetailPembelian::All();
        $penjualan = 0;
        $pembelian = 0;
        $thpp = 0;
        $tdis = 0;
        $thpptd = 0;
        $tdistd = 0;
        $lmonthbuy = 0;
        $lmonthsell = 0;
        $lmonthuntung = 0;
        $gp = 0;
        $gu = 0;
        $gb = 0;
        $ghl = 0;
        $thppbl = 0;
        $tdisbl = 0;
        $ldaysell = 0;
        
        $penjualantd = 0;
        $pembeliantd = 0;
        $keuntungantd = 0;
        

        foreach($nota as $item){
            foreach($item->detilnota as $items){
                $penjualan += $items->subtotal;
                $thpp += $items->hpp;
                $tdis += $items->diskon;
            }
        }

        foreach($notabl as $item){
            foreach($item->detilnota as $items){
                $lmonthsell += $items->subtotal;
                $thppbl += $items->hpp;
                $tdisbl += $items->diskon;
            }
        }

        foreach($notatd as $item){
             foreach($item->detilnota as $items){
                $penjualantd += $items->subtotal;
                $thpptd += $items->hpp;
                $tdistd += $items->diskon;
            }
        }

        foreach($notayt as $item){
            foreach($item->detilnota as $items){
                $ldaysell += $items->subtotal;
            }
        }
        
        foreach($restock as $item){
            $pembelian += $item->total;
        }

        foreach($restockbl as $item){
            $lmonthbuy += $item->total;
        }

        if($ldaysell > 0){
            $ghl = (($penjualantd - $ldaysell) / $ldaysell) * 100;
        }else if($penjualantd > 0){
            $ghl = 100;
        }


        if($lmonthbuy > 0){
            $gb = (($pembelian - $lmonthbuy) / $lmonthbuy) * 100;
        }else if($pembelian > 0){
            $gb = 100;
        }

        foreach($restocktd as $item){
            $pembeliantd += $item->total;
        }

        $keuntungan = $penjualan - ($thpp + $tdis);
        $lmonthuntung = $lmonthsell - ($thppbl + $tdisbl);
        $keuntungantd = $penjualantd - ($thpptd + $tdistd);

        if($lmonthsell > 0){
            $gp = (($penjualan - $lmonthsell) / $lmonthsell) * 100;
        }else if($penjualan > 0){
            $gp = 100;
        }

        if($lmonthuntung > 0){
            $gu = (($keuntungan - $lmonthuntung) / $lmonthuntung) * 100;
        }else if($keuntungan > 0){
            $gu = 100;
        }
        
        $filterYear = $request->input('filterYear', date('Y'));

        $salesData = Nota::selectRaw('
            MONTH(tanggal) as month,
            SUM(total) as total
        ')
        ->whereYear('tanggal', $filterYear)
        ->groupBy('month')
        ->orderBy('month')
        ->get();
        
        $currentYearSales = Nota::whereYear('tanggal', $filterYear)->sum('total');
        $lastYearSales = Nota::whereYear('tanggal', $filterYear - 1)->sum('total');
        $growth = 0;
        if ($lastYearSales > 0) {
            $growth = (($currentYearSales - $lastYearSales) / $lastYearSales) * 100;
        } elseif ($currentYearSales > 0) {
            $growth = 100;
        }

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $salesOverview = [
            'labels' => $months,
            'data' => array_fill(0, 12, 0)
        ];

        foreach ($salesData as $sale) {
            $salesOverview['data'][$sale->month - 1] = $sale->total;
        }

        $tempo = Restock::where('tanggal_tempo', '<=', Carbon::now()->addDays(7))
        ->whereNull('tbayar')
        ->get();


        return view('dashboard', compact('user', 'nota', 'kategori', 'restock', 
        'penjualan', 'pembelian', 'keuntungan', 'penjualantd', 'pembeliantd', 
        'keuntungantd', 'salesOverview', 'detilNota', 'detilBeli', 'stok', 
        'thpp', 'tdis', 'thpptd', 'tdistd', 'growth', 'gp', 'gu', 'gb', 'ghl', 'varian', 'tempo', 'laris'));
    }
}
