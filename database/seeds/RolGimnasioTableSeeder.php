<?php

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
            //if($user )
        }
    }
}
