<?php

namespace App\Traits;

use App\Models\Pago;
use App\Models\Log as OwnLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait CanBePagar
{
    public function pagos()
    {
        return $this->morphMany(Pago::class, 'pagable');
    }


    public function addPago($concepto, $precio, $pagableFecha = '2001-01-01', $parcial = false, $metodo,$caja)
    {
        $this->pagos()->create(
            [
                'pagable_at' => $pagableFecha,
                'pagable_id' => $this->id,
                'pagable_type' => get_class($this),
                'concepto' => $concepto,
                'precio' => $precio,
                'parcial' => $parcial,
                'metodo_pago_id' => $metodo,
                'caja_id' => $caja,
            ]
        );
    }
    public function desadeudar()
    {
		OwnLog::create([
			'message' => "Desadeudado " . $this->user->name . " de Deuda: " . $this->deuda()->concepto . "/" . $this->deuda()->precio
		]);
        $this->deuda()
            ->delete();
        $this->pagado = 1;
        $this->refreshDeudas();
    }
    protected function refreshDeudas()
    {
        $this->save();
    }
}
