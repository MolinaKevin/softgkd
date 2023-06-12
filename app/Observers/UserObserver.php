<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function updated(User $user)
    {
		$user->actualizarEstado();
    }

    public function created(User $user)
    {
		$user->actualizarEstado();
    }
    
}

