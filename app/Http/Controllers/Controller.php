<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Category;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
    	// injecter les categories dans la vue partial nav
    	view()->composer('partials.nav', function($view) {

    		$categories = Category::select('id','title','slug')->get();
    		$view->with(compact('categories'));

    	});
    }
} 
