<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Product;

// PHPUnit Testcase configure PHPunit pour laravel

class CartTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    protected $cart;

   	public function setUp() {
   		parent::setUp();
   		$this->cart = $this->app['App\Cart\Cart'];
   		$p1 = Product::create([
   			'name'=>'product one',
   			'price'=> 9999,
   			'quantity'=>5,
   		]);
   		$this->cart->buy($p1, 4);
   	}

   	public function testInstanceOfServiceCart() {
   		$this->assertInstanceOf('App\Cart\Cart', $this->cart);
   	}

   	/*public function testStorageEmpty() {
   		$this->assertEquals([], $this->cart->getCart());
   	}*/

   	public function testCalculTotal() {

   	}
}
