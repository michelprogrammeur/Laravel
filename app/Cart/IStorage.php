<?php

namespace App\Cart;

interface IStorage {

	function setValue($id, $total, $price, $quantity);

	function getValue($id);

	function restore($id);

	function total();

	function get();

	function reset();

	function count();
}