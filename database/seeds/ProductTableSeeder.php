<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 15)->create()->each(function($product) {
        	// tags() => utilisation de la relation pas faire la requête
        	$rangeRand = range(1, rand(2,5));
        	$product->tags()->attach($rangeRand);  // 5 = en fonction du nombres de tags créer
        });
    }
}
