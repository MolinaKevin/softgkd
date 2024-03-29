<?php

namespace App\Http\Controllers;

use App\Models\Opcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class OpcionController extends Controller
{
    public function todosCorrecto() {
        $opcion = Opcion::where('clave','correctos')->first();

        $opcion->valor = 1;

        $opcion->save();

        return view('opciones');

    }

    public function quitarCorreto() {
        $opcion = Opcion::where('clave','correctos')->first();

        $opcion->valor = 0;
        
        $opcion->save();

        return view('opciones');

    }

    public function scriptEstados() {
        Artisan::call('update:estados');

        return view('opciones');
    }

    public function scriptPlanes() {
        Artisan::call('update:planes');

        return view('opciones');
    }



}
