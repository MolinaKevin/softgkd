<?php

use App\Models\PlanUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolGimnasioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $plan = $user->plans->find(34);
            $pivot = PlanUser::find($plan->pivot->id);
            $pivot->adeudar();
        }
    }
}
