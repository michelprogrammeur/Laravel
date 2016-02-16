<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function show() {
		$category = "PHP 7";

		return view('category', compact('category'));
	}
}
