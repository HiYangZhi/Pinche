<?php

use Illuminate\Database\Seeder;
use ZCJY\Pinche\User;

class UserTalbeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'admin',
            'email' => 'yyjz@foxmail.com',
            'password'=>Hash::make('fengwei2345*'),
        ]);
    }
}
