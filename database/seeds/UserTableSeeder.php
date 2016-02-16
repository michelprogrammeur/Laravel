<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
				'name'     =>'Tony',
				'email'    =>'tony@tony.fr',
				'password' => Hash::make('Tony')
        	],
        	[
				'name'     =>'Patrick',
				'email'    =>'patrick50ans@logement.fr',
				'password' => Hash::make('Patrick')
        	],
        ]);
    }
}
