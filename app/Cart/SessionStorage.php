<?php

namespace App\Cart;

class SessionStorage implements IStorage
{

	protected $storage=[];

	public function __construct()
	{
		if(!empty(session()->has('cart'))) 
			$this->storage = session()->get('cart');
	}
	
	public function get(){

	}

	public function setValue($id, $total) {
		
		if(!empty($this->storage[$id]))
		{
			$this->storage[$id]+=$total;
		}

		$this->storage[$id]=$total;

		session()->push('cart', $this->storage);
		session()->save();
	}
}