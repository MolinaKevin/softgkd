<?php

namespace App\Traits;

use App\Models\Pago;

trait CanBePagar
{
    public function pagos()
    {
        return $this->morphMany(Pago::class, 'pagable');
    }


    public function addPago($concepto, $precio)
    {
        $this->pagos()->updateOrCreate(
            [
                'pagable_id' => $this->id,
                'pagable_type' => get_class($this),
                'concepto' => $concepto,
                'precio' => $precio
            ]
        );
    }
    public function desadeudar()
    {
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