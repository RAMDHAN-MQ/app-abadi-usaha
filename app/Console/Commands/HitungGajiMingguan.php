<?php

namespace App\Console\Commands;

use App\Http\Controllers\GajiController;
use Illuminate\Console\Command;

class HitungGajiMingguan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gaji:generate-mingguan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghitung dan membuat rekap gaji mingguan untuk periode sebelumnya.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new GajiController)->generateGajiMingguan();
        $this->info('Gaji mingguan otomatis dijalankan.');
    }
}
