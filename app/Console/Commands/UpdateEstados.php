<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Log as OwnLog;
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
				OwnLog::create(['message' => "cambio de estado de usuario " . $user->name . " de (" . $user->estado . ") a (Supra) el (" . Carbon::now() . ")"]);
                $user->estado = "Supra";
            } elseif ($user->hasDeuda()) {
				OwnLog::create(['message' => "cambio de estado de usuario " . $user->name . " de (" . $user->estado . ") a (Deuda) el (" . Carbon::now() . ")"]);
                $user->estado = "Deuda";
            } elseif ($user->isInactivo()) {
				OwnLog::create(['message' => "cambio de estado de usuario " . $user->name . " de (" . $user->estado . ") a (Inactivo) el (" . Carbon::now() . ")"]);
                $user->estado = "Inactivo";
            } elseif ($user->hasRevisacionVencida()) {
				OwnLog::create(['message' => "cambio de estado de usuario " . $user->name . " de (" . $user->estado . ") a (Revisacion) el (" . Carbon::now() . ")"]);
                $user->estado =  "Revisacion";
            } elseif (!$user->hasHuella() && !$user->hasTag()) {
				OwnLog::create(['message' => "cambio de estado de usuario " . $user->name . " de (" . $user->estado . ") a (Metodo de acceso) el (" . Carbon::now() . ")"]);
                $user->estado =  "Metodo de acceso";
            } elseif ($user->hasPlanEspecial()) {
				OwnLog::create(['message' => "cambio de estado de usuario " . $user->name . " de (" . $user->estado . ") a (Plan especial) el (" . Carbon::now() . ")"]);
                $user->estado =  "Plan Especial";
            } else {
				OwnLog::create(['message' => "cambio de estado de usuario " . $user->name . " de (" . $user->estado . ") a (Correcto) el (" . Carbon::now() . ")"]);
                $user->estado =  "Correcto";
            }

            $user->save();
        }
        Log::info('Estados actualizados' . Carbon::now());
        $this->info('Se han actualizado todos los estados correctamente!');

    }
}
