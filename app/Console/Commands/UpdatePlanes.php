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
        $planUser = PlanUser::where('pagado', '=', 1)->get();

        foreach ($planUser as $pivot) {
            if($pivot->vencePorFecha() && $pivot->isVencido()) {
                $pivot->adeudar();
                $pivot->user->familia->deudas()->save($pivot->deuda);
            }
        }

        $especialUser = EspecialUser::where('pagado', '=', 1)->get();
//
        foreach ($especialUser as $pivot) {
            if($pivot->vencePorFecha() && $pivot->isVencido() && !$pivot->renovable) {
                $pivot->adeudar();
                $pivot->user->familia->deudas()->save($pivot->deuda);
            } else {
                $pivot->especial()->delete();
            }
        }

        Log::info('Planes actualizados');

        $this->info('Se han actualizado todos los planes vencidos correctamente!');
    }
}
