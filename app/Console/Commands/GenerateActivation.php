<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GenerateActivation extends Command
{
    protected $signature = 'activation:generate';
    protected $description = 'Generate activation file with current IP address';

    public function handle()
    {
        $path = storage_path('secure/activation.json');

        if (file_exists($path)) {
            $this->warn('⚠️ Activation file already exists!');
            return;
        }

        $ip = $this->getPublicIp();

        if (!$ip) {
            $this->error('❌ Failed to detect public IP.');
            return;
        }

        $data = [
            'ip' => $ip,
            'activated_at' => now()->toDateTimeString(),
        ];

        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));

        $this->info("✅ Activation created with IP: $ip");
    }

    private function getPublicIp()
    {
        try {
            $response = Http::get('https://api.ipify.org?format=json');
            return $response->json()['ip'] ?? null;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
