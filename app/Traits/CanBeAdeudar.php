<?php

namespace App\Traits;

use App\Models\Deuda;

trait CanBeAdeudar
{
    public function deuda()
    {
        return $this->morphOne(Deuda::class, 'deudable');
    }
    public function getCurrentVoteAttribute()
    {
        if (auth()->check()) {
            return $this->userVote->vote;
        }
    }

    public function getVoteFrom(User $user)
    {
        return $this->votes()
            ->where('user_id', $user->id)
            ->value('vote');
    }


    public function adeudar($especial = false)
    {
        if($this->precio > 0) {
            $this->addDeuda($especial);
        }
        return false;
    }

    public function obtenerMorph(&$id,&$type,&$concepto, $especial)
    {
        if ($especial) {
            $agregar = " especial ";
        } else {
            $agregar = "";
        }
        if ($this->user->familia->name == "Sin Familia")
        {
            $id = $this->user->id;
            $type = get_class($this->user);
            $concepto = 'Deuda de: ' . $this->user->name . ' por el plan ' . $agregar . ' ' . $this->name;
            return false;
        }
        $concepto = 'Deuda de: Familia ' . $this->user->familia->name . ' por el plan ' . $agregar .' ' . $this->name;
        $id = $this->user->familia->id;
        $type = get_class($this->user->familia);
        return false;
    }

    protected function addDeuda($especial)
    {
        $this->obtenerMorph($adeudable_id,$adeudable_type,$concepto, $especial);
        $this->deuda()->updateOrCreate(
            [
                'adeudable_id' => $adeudable_id,
                'adeudable_type' => $adeudable_type,
                'concepto' => $concepto,
                'precio' => $this->precio
            ]
        );
        $this->pagado = 0;
        $this->refreshDeudas();
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