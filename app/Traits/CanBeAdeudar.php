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
                'concepto' => 'Deuda de: ' . $this->getTable() . ' ' . $this->name,
                'precio' => $this->precio
            ]
        );
        $this->refreshDeudas();
    }
    public function desadeudar()
    {
        $this->deuda()
            ->delete();
        $this->refreshDeudas();
    }
    protected function refreshDeudas()
    {
        //$this->score = $this->votes()->sum('vote');
        $this->save();
    }
}