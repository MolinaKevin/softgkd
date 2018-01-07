<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\Models\User::class)->create([
            'name' => 'Admin',
            'email' => 'soft@gkd.com',
            'password' => 'DavidH4P'
        ]);
        $user->roles()->attach(\App\Models\Role::find(2));
    }
}
