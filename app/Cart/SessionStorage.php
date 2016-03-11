<?php

namespace App\Cart;

class SessionStorage implements IStorage
{

	protected $storage=[];


	public function __construct()
	{
		if(session()->has('cart')) {
			$this->storage = session()->get('cart');
		}
	}
	
	public function setValue($id, $total, $price, $quantity) {
		
		if(!empty($this->storage[$id])) {
			$this->storage[$id]['total'] += $total;
		}else {
			$this->storage[$id]['total'] = $total;
		}


		session()->put('cart', $this->storage);
		return;
	}

	public function getValue($id) {
		
        if (!empty($this->storage)) {
        	return $this->storage[$id];
        }
        return;
    }

    public function restore($id) {
		if (!empty($this->storage[$id])) {
            unset($this->storage[$id]);
            session()->put('cart', $this->storage);
        }
	}

	public function reset() {
		session()->forget('cart');
	}

	public function total() {
		$total = 0;
		if (!empty($this->storage)) {
            foreach ($this->storage as $storage) {
            	$total += $storage['total'];
            }
        }
        return $total;
	}

	public function get() {
		return $this->storage;
	}

	public function count() {
	
		return count($this->storage);
	}
}