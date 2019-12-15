<?php

namespace App\Http\Controllers;

use App\Models\Opcion;
use Illuminate\Http\Request;

class OpcionController extends Controller
{
    public function todosCorrecto() {
        $opcion = Opcion::where('clave','correctos')->get();

        $opcion->valor = 1;
    }

    public function quitarCorreto() {
        $opcion = Opcion::where('clave','correctos')->get();

        $opcion->valor = 0;
    }

}
