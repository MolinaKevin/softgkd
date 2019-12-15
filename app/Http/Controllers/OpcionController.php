<?php

namespace App\Http\Controllers;

use App\Models\Opcion;
use Illuminate\Http\Request;

class OpcionController extends Controller
{
    public function todosCorrecto() {
        $opcion = Opcion::where('clave','correctos')->first();

        $opcion->valor = 1;

        $opcion->save();

        return view('home');

    }

    public function quitarCorreto() {
        $opcion = Opcion::where('clave','correctos')->first();

        $opcion->valor = 0;
        
        $opcion->save();

        return view('opciones');

    }

}
