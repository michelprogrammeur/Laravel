<?php 

namespace App\Cart;

class Cart 
{
	protected $storage;
	private $cart;
	
	public function __construct(IStorage $storage)
	{
		$this->storage = $storage;
	}

	public function buy($product, $quantity)
    {
    	$total = $product->price * ((int)$quantity);
		$this->storage->setValue($product->id, $total, $product->price, $quantity);
    }

    public function reset() {
		$this->storage->reset();
    }

    public function restore($id) {
		$this->storage->restore($id);
    }

    public function get() {
		return $this->storage->get();
	}

	public function total()
    {
        return $this->storage->total();
    }
}


