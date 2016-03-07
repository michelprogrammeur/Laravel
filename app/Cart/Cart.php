<?php 

namespace App\Cart;

class Cart 
{
	protected $storage;
	
	public function __construct(IStorage $storage)
	{
		$this->storage = $storage;
	}


	public function buy($product, $quantity)
    {
    	$total = $product->price * ((int)$quantity);
		$this->storage->setValue($product->id, $total);

		dd(session()->get('cart'));
    }
    
}


