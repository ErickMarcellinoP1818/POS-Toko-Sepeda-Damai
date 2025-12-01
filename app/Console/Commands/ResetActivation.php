<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetActivation extends Command
{
    protected $signature = 'activation:reset';
    protected $description = 'Reset activation lock (only for internal use)';

    public function handle()
    {
        $file = storage_path('secure/activation.json');

        if (file_exists($file)) {
            unlink($file);
            $this->info('✅ Activation has been reset.');
        } else {
            $this->warn('⚠️ Activation file not found.');
        }
    }
}
