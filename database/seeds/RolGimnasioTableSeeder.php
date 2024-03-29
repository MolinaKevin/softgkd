<?php

use App\Models\Plan;
use App\Models\PlanUser;
use App\Models\User;
use Carbon\Carbon;
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

            $plan = Plan::find(35);
            $user->plans()->attach(35);
            switch ($plan->date) {
                case 0:
                    $user->plans()->updateExistingPivot($plan->id, ['clases' => $plan->cantidad + $input['adicion']]);
                    break;
                case 1:
                    $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addDays($plan->cantidad + $input['adicion'])->endOfDay()]);
                    break;
                case 2:
                    $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addWeek()]);
                    break;
                case 3:
                    $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addMonth()]);
                    break;
                case 4:
                    $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addYear()]);
                    break;
                default:
                    $user->plans()->updateExistingPivot($plan->id, ['clases' => $plan->cantidad + $input['adicion']]);
                    break;
            }
            $user->save();
        }
    }
}
