<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('tags')->insert([
        	[
				'name' => 'lightlaser'
        	],
        	[
				'name' => 'stuff'
        	],
        	[
				'name' => 'collector'
        	],
        	[
				'name' => 'jedi'
        	],
        	[
				'name' => 'laser'
        	],
        ]);
    }
}
