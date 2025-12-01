<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class TransController extends Controller
{
  public function transaksi(Request $request)
    {
        try {
            $cart = session()->get('cart');

            $request->validate([
                'total' => 'required|numeric',
                'bayar' => 'required|numeric',
                'inv_num' => 'required|string',
            ]);

            if (!$cart || count($cart) === 0) {
                throw new \Exception('Keranjang belanja kosong. Tidak dapat memproses transaksi.');
            }

            $serverKey = 'SB-Mid-server-S12GyG6i4EAU5NdCBSk6_vFb';
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
            ])->post('https://api.sandbox.midtrans.com/v2/charge/', [
                'payment_type' => 'qris',
                'transaction_details' => [
                    'order_id' => $request->inv_num,
                    'gross_amount' => $request->total,
                ],
                'qris' => [
                    'acquirer' => 'gopay'
                ]
            ]);

            \Log::info('MIDTRANS RESPONSE:', $response->json());

            if (!$response->successful()) {
                throw new \Exception($response->json('status_message') ?? 'Gagal memproses pembayaran');
            }

            $data = $response->json();

            $qrUrl = collect($data['actions'] ?? [])
                ->where('name', 'generate-qr-code')
                ->first()['url'] ?? null;

            if (!$qrUrl) {
                throw new \Exception('QR code tidak tersedia dalam respons Midtrans.');
            }

            return response()->json([
                'success' => true,
                'qr' => $qrUrl,
                'inv_num' => $request->inv_num,
                'transaction_id' => $data['transaction_id']
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function checkPaymentStatus(Request $request)
    {
        $serverKey = 'SB-Mid-server-S12GyG6i4EAU5NdCBSk6_vFb';
        $transactionId = $request->query('transaction_id');

        $response = Http::withBasicAuth($serverKey, '')
            ->get("https://api.sandbox.midtrans.com/v2/{$transactionId}/status");

        if (!$response->successful()) {
            return response()->json(['status' => 'error'], 500);
        }

        return response()->json($response->json());
    }

   
}
