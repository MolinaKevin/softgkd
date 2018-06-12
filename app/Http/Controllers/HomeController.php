<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Dispositivo;
use Illuminate\Http\Request;
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
            ->take(7)
            ->get();
        $ingresos->each(function ($model) { $model->user->setAppends(['revisacion']); });
        $dispositivos = Dispositivo::all();
        $dispositivos->each(function ($model) { $model->setAppends(['ultima_hora']); });
        return view('home', compact(['ingresos','dispositivos']));
    }
}
