<?php

namespace App\Http\Controllers;

use App\Models\Opcion;
use Illuminate\Http\Request;

class OpcionController extends Controller
{
    public function todosCorrecto() {
        $opcion = Opcion::where('clave','correctos')->get();
        $opcion = $opcion[0];

        $opcion->valor = 1;

        $opcion->save();
    }

    public function quitarCorreto() {
        $opcion = Opcion::where('clave','correctos')->get();
        $opcion = $opcion[0];

        $opcion->valor = 0;
        
        $opcion->save();
    }

}
