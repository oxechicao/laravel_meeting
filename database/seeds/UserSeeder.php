<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'User Demonstration Dev',
            'email' => 'user@demo.dev',
            'password' => Hash::make('password'),
        ]);
    }
}
