<?php

namespace App\Http\Controllers;

use App\Models\Arqueo;
use App\Models\Asistencia;
use App\Models\Dispositivo;
use App\Models\Movimiento;
use App\Models\Pago;
use App\Models\Revisacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingresos = Asistencia::latest()
            ->take(5)
            ->get();
        $ingresos->each(function ($model) { $model->user->setAppends(['revisacion']); });
        $dispositivos = Dispositivo::all();
        $dispositivos->each(function ($model) { $model->setAppends(['ultima_hora']); });
        $revisaciones = Revisacion::orderBy('finalizacion','desc')
            ->where('finalizacion', '>', Carbon::now())
            ->take(5)
            ->get();
        $arqueoUltimo = Arqueo::orderBy('created_at','desc')->first();
        if (!$arqueoUltimo) {
            $arqueo = new \stdClass();
            $arqueo->created_at = '1999-01-01 00:00:01';
        }

        //$movimientos = Movimiento::where('created_at', '>=', $arqueoUltimo->created_at)->get();
        //$pagos = Pago::where('created_at', '>', $arqueoUltimo->created_at)->get();
        $total = 0;
        $movimientos = [];
        $pagos = [];
        foreach ($movimientos as $movimiento) {
            $total += $movimiento->precio;
        }
        foreach ($pagos as $pago) {
            $total += $pago->precio;
        }
        $caja = 0;
        $arqueos = Arqueo::all();
        foreach ($arqueos as $arqueo) {
            $caja += $arqueo->total;
        }
        $caja += $total;
        $dispositivo = Dispositivo::find(1);

        //$ingresados = $dispositivo->ingresados;
        $ingresados = [];

        //$plans = $dispositivo->plans;
        //$plans = $plans->concat($dispositivo->especials);
        $plans=[];
        $ingresables = 0;
        foreach ($plans as $ingresable) {
            foreach ($ingresable->users->unique() as $user) {
                if (($user->estado ==  "Correcto" || $user->estado ==  "Sin Huella") && ! $user->isRole('admin')) {
                    $ingresables++;
                }
            }
        }
        $users = User::all();
        foreach ($users as $user) {
            if ($user->isRole('staff')) {
                $ingresables++;
            }
        }
        $ingresables--; //Doctor Doctor

        return view('home', compact(['ingresos','dispositivos','revisaciones','caja','ingresados','ingresables']));
    }

    public function opciones()
    {
        return view('opciones');
    }
}
