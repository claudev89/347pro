<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LimpiarSuscripcionesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:limpiar-suscripciones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando elimina solicitudes de suscripción que tengan 30 días de antigüedad.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('suscripcions')->whereNotNull('hash')->where('created_at', '<=', now()->subDays(30))->delete();
        return Command::SUCCESS;
    }
}
