<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateEstados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:estados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Se actualizan los estados del sistema';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->hasSupra()) {
                $user->estado = "Supra";
            } elseif ($user->hasDeuda()) {
                $user->estado = "Deuda";
            } elseif ($user->isInactivo()) {
                $user->estado = "Inactivo";
            } elseif ($user->hasRevisacionVencida()) {
                $user->estado =  "Revisacion";
            } elseif (!$user->hasHuella() && !$user->hasTag()) {
                $user->estado =  "Metodo de acceso";
            } elseif ($user->hasPlanEspecial()) {
                $user->estado =  "Plan Especial";
            } else {
                $user->estado =  "Correcto";
            }

            $user->save();
        }
        Log::info('Estados actualizados' . Carbon::now());
        $this->info('Se han actualizado todos los estados correctamente!');

    }
}
