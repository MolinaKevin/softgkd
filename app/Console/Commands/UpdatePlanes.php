<?php

namespace App\Console\Commands;

use App\Models\EspecialUser;
use App\Models\PlanUser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdatePlanes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:planes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cada día comprueba si algun plan vencio y genera la deuda correspondiente';

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
        $planUser = PlanUser::where('pagado','=',1)->with('user')->get();

        foreach ($planUser as $pivot) {
            if ($pivot->user !== null) {
                if (!$pivot->user->isInactivo()) {
                    if ($pivot->vencePorFecha() && $pivot->isVencido()) {
                        $pivot->adeudar();
                        $pivot->renovar();
                        if ($pivot->deuda) {
                            if ($pivot->user->hasFamilia()) {
                                $pivot->user->familia->deudas()->save($pivot->deuda);
                            } else {
                                $pivot->user->deudas()->save($pivot->deuda);
                            }
                        }
                    }
                }
            }
        }

        $planUser = PlanUser::where('pagado','=',0)->with('user')->get();

        foreach ($planUser as $pivot) {
            if ($pivot->user !== null) {
                if (!$pivot->user->isInactivo()) {
                    if ($pivot->vencePorFecha() && $pivot->isVencido() && !$pivot->user->hasDeuda()) {
                        $pivot->adeudar();
                        $pivot->renovar();
                        if ($pivot->deuda) {
                            if ($pivot->user->hasFamilia()) {
                                $pivot->user->familia->deudas()->save($pivot->deuda);
                            } else {
                                $pivot->user->deudas()->save($pivot->deuda);
                            }
                        }
                    }
                }
            }
        }

        $especialUser = EspecialUser::where('pagado','=',1)->with('user')->get();

        foreach ($especialUser as $pivot) {
            if ($pivot->user !== null) {
                if (!$pivot->user->isInactivo()) {
                    if ($pivot->vencePorFecha() && $pivot->isVencido() && ($pivot->especial->renovable == 1)) {
                        $pivot->adeudar();
                        if ($pivot->user->hasFamilia()) {
                            $pivot->user->familia->deudas()->save($pivot->deuda);
                        } else {
                            $pivot->user->deudas()->save($pivot->deuda);
                        }
                        $pivot->renovar();
                    } elseif ($pivot->isVencido() && ($pivot->especial->renovable == 0)) {
                        $pivot->especial()->delete();
                        $pivot->delete();
                    }
                }
            }
        }

        Log::info('Planes actualizados' . Carbon::now());

        $this->info('Se han actualizado todos los planes vencidos correctamente!');
    }
}
