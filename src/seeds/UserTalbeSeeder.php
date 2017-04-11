<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTalbeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'pincheadmin',
            'email' => 'yyjz@foxmail.com',
            'password'=>Hash::make('fengwei2345*'),
        ]);
    }
}
