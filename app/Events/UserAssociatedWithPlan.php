<?php

namespace App\Events;

use App\Models\User;
use App\Models\Plan;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class UserAssociatedWithPlan
{
    use Dispatchable, SerializesModels;

    public $user;
    public $plan;

    public function __construct(User $user, Plan $plan)
    {
        $this->user = $user;
        $this->plan = $plan;
    }
}

