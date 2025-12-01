<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $activationPath = storage_path('secure/activation.json');

        if (!file_exists(dirname($activationPath))) {
            mkdir(dirname($activationPath), 0777, true);
        }

        $fingerprint = [
            'device' => gethostname(),
            'os' => php_uname(),
        ];

        $fingerprintJson = json_encode($fingerprint);
        $fingerprintHash = hash('sha256', $fingerprintJson);

        if (!file_exists($activationPath)) {
            $data = [
                'fingerprint' => $fingerprint,
                'hash' => $fingerprintHash,
                'activated_at' => now()->toDateTimeString(),
            ];
            file_put_contents($activationPath, json_encode($data, JSON_PRETTY_PRINT));
        } else {
            $saved = json_decode(file_get_contents($activationPath), true);

            $valid = isset($saved['fingerprint'], $saved['hash']) &&
                hash('sha256', json_encode($saved['fingerprint'])) === $saved['hash'];

            if (!$valid) {
                abort(403, '❌ Aktivasi tidak valid atau data diubah secara paksa.');
            }

            // Cek fingerprint match (mesin sama)
            if ($saved['fingerprint'] !== $fingerprint) {
                abort(403, '❌ Program hanya boleh dijalankan di mesin yang sudah diaktivasi.');
            }
        }
        // if(config('app.env') === 'local'){
        //     URL::forceScheme('https');
        // }
    }
}
