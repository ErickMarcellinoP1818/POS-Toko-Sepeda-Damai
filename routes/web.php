<?php

use App\Http\Controllers\DetilNotaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\ProdukHomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RestockController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\TransController;
use App\Models\Produk;





Route::get('/', function () {
    $produk = Produk::where('status', 'aktif')
    ->limit(8)
    ->inRandomOrder()
    ->get();
    return view('home', compact('produk'));
});


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');

Route::get('logout', [LoginController::class, 'actionLogout'])->name('actionLogout')->middleware('auth');
Route::get('home', [LoginController::class, 'homer'])->name('homer')->middleware('auth', 'verified');

Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionRegister'])->name('actionRegister');
Route::get('register/verify/{verify_key}', [RegisterController::class, 'verify'])->name('verify');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? redirect()->route('login')->with(['status' => __($status)])->with('success', 'Email berhasil dikirim')
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::get('profil', [UserController::class, 'profil'])->name('profil');
Route::put('/user/{id}/update', [UserController::class, 'update1'])->name('user.update1');
Route::put('/user/{id}/updatefoto', [UserController::class, 'updateFoto'])->name('user.updatefoto');
Route::resource('/user', UserController::class);

Route::resource('/detilnota', DetilNotaController::class);
Route::get('/shopping-cart', [DetilNotaController::class, 'ProdukCart'])->name('shopping.cart');
Route::get('/product/{id}', [DetilNotaController::class, 'addProduktoCart'])->name('addproduk.to.cart');
Route::patch('/update-shopping-cart', [DetilNotaController::class, 'updateCart'])->name('update.shopping.cart');
Route::patch('/update-diskon', [DetilNotaController::class, 'diskonAdd'])->name('update.diskon');
Route::delete('/delete-cart-product', [DetilNotaController::class, 'deleteProduct'])->name('delete.cart.product');

Route::resource('/produks', ProdukController::class)->except('show')->middleware('auth');
Route::get('/produk', [ProdukController::class, 'prodHom'])->name('prodHom')->middleware('auth', 'verified');

Route::resource('/produkHome', ProdukHomeController::class);

Route::resource('/pesanan', PesananController::class)->except('show');

Route::patch('/update-shopping-cart', [DetilNotaController::class, 'updateCart'])->name('update.shopping.cart');
Route::delete('/delete-cart-product', [DetilNotaController::class, 'deleteProduct'])->name('delete.cart.product');

Route::resource('/restock', RestockController::class)->except('show')->middleware('auth');
Route::get('/tempo', [RestockController::class, 'tempo'])->name('tempo');

Route::resource('/kategori', KategoriController::class)->except('show')->middleware('auth');
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::resource('/supplier', SupplierController::class)->except('show')->middleware('auth');

Route::post('/bayar', [PesananController::class, 'cash'])->name('bayar');
Route::get('/nota/{id}/detail', [DetilNotaController::class, 'detail'])->name('nota.detail');
Route::get('/nota/{id}/print', [DetilNotaController::class, 'print'])->name('nota.print');
Route::post('/pembayaran-qr', [TransController::class, 'transaksi'])->middleware('auth');
Route::post('/qris-sukses', [PesananController::class, 'qrisSelesai'])->name('qris.sukses');
Route::get('/chpw', [UserController::class, 'CHPWpage'])->name('changepassword')->middleware('auth');
Route::post('/chpwu', [UserController::class, 'changePassword'])->name('user.changepassword')->middleware('auth');

Route::get('/nota/{id}/detail', [DetilNotaController::class, 'detail'])->name('nota.detail');

Route::delete('/delete-foto/{id}', [UserController::class, 'hapusFoto'])->name('user.deleteFoto')->middleware('auth');

Route::get('/pembelian/option', [RestockController::class, 'option'])->name('pembelian.option');
Route::get('/pembelian/{id}/detail', [RestockController::class, 'detail'])->name('pembelian.detail');
Route::get('/pembelian/{id}/tempod', [RestockController::class, 'detail'])->name('pembelian.tempod');
Route::get('/pembelian/print', [RestockController::class, 'print'])->name('pembelian.print');

Route::get('/penjualan/option', [DetilNotaController::class, 'option'])->name('penjualan.option');
Route::get('/penjualan/print', [DetilNotaController::class, 'printResume'])->name('penjualan.print');
Route::get('/rincianbeli', [RestockController::class, 'rincian'])->name('rincianbeli');

Route::get('/tambahbeli', [RestockController::class, 'addToBuy'])->name('tambahbeli');
Route::post('/pembelian/add', [RestockController::class, 'addPembelian'])->name('pembelian.add');

Route::post('/pembelian/update/{id}', [RestockController::class, 'updatePembelian'])->name('pembelian.update');
Route::delete('/pembelian/delete', [RestockController::class, 'deletePembelian'])->name('pembelian.delete');
Route::get('/pembelian/edit/{id}', [RestockController::class, 'editModal'])->name('pembelian.edit');
Route::get('/pembelian/bayar/{id}', [RestockController::class, 'bayar'])->name('pembelian.bayar');

Route::get('/reset-beli', function () {
    session()->forget('beli');
    return redirect()->back();
})->name('beli.lupa');

Route::get('/labarugi', [DetilNotaController::class, 'labaRugi'])->name('labarugi');
Route::get('/labarugi/option', [DetilNotaController::class, 'option'])->name('labarugi.option');
Route::get('/labarugi.print', [DetilNotaController::class, 'printLabaRugi'])->name('labarugi.print');
Route::get('/labarugi/{id}/detail', [DetilNotaController::class, 'detailLabaRugi'])->name('labarugi.detail');

Route::resource('/karyawan', KaryawanController::class)->except('show');
Route::post('/karyawan/upjabatan', [KaryawanController::class, 'upjabatan'])->name('karyawan.upjabatan');

Route::resource('/dashboard', DashboardController::class)->only('index')->middleware('auth');
Route::get('/produk/varian', [ProdukController::class, 'addVarian'])->name('produk.varian')->middleware('auth');
Route::post('/produk/varian/temp', [ProdukController::class, 'tempVarian'])->name('produk.varian.temp')->middleware('auth');
Route::delete('/temp-varian-delete', [ProdukController::class, 'deleteTemp'])->name('varian.temp.delete');
Route::post('/pembelian/update-varian', [RestockController::class, 'updateVarian'])->name('pembelian.update_varian');
Route::get('/pembelian/cotempo', [RestockController::class, 'coTempo'])->name('pembelian.cotempo');
Route::get('/produks/cancel', function () {
    session()->forget('varian');
    return redirect('/produks')->with('success', 'Membatalkan...');
})->name('produks.cancel');
Route::get('/varian/session/{index}', [ProdukController::class, 'editVarianTemp'])->name('varian.showSession');
Route::get('/varian/{id}/edit', [ProdukController::class, 'editVarian'])->name('varian.edit');
Route::put('/varian/{id}/update', [ProdukController::class, 'updateVarian'])->name('varian.update');
Route::get('/varian/{id}/delete', [ProdukController::class, 'deleteVarian'])->name('varian.delete');
Route::post('/produk/varian/temp/update/{index}', [ProdukController::class, 'updateTemp'])->name('produk.varian.temp.update');
Route::get('/check-payment-status', [TransController::class, 'checkPaymentStatus']);