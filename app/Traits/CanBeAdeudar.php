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


    public function adeudar()
    {
        $this->addDeuda();
    }

    protected function addDeuda()
    {
        $this->deuda()->updateOrCreate(
            [
                'concepto' => 'Deuda de: ' . $this->user()->name . ' por el plan ' . $this->name,
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