<?php

namespace App\Cart;

interface IStorage {
	
	function get();

	function setValue($id, $total);
}