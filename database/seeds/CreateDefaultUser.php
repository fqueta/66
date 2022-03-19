<?php

use Illuminate\Database\Seeder;

class CreateDefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Demo',
	        'email' => 'demo@example.com',
	        'password' => bcrypt('demo123'),
        ]);
    }
}
