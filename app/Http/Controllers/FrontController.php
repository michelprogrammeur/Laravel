<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;
use Cache;

class FrontController extends Controller
{

    public function index() {

        if(Cache::has('products')) {
            $products = Cache::get('products');
        }else {
            $products = Product::with('tags', 'picture', 'category')->paginate(10);
            Cache::put('products', $products, 1); 
        }

    	return view('front.index', compact('products'));
    }

    public function show($id, $slug=''){
    	$product = Product::find($id);

    	return view('front.show', compact('product'));

    }

    public function showProductByCategory($id, $slug=''){
    	$products = Category::find($id)->products;

    	return view('front.category', compact('products'));

    }

    public function showContact(){

    	return view('front.contact');

    }

    public function sendContact(Request $request){   // dans le conteneur de service il injecte la request
    	//dd($request->all());

    	$this->validate($request, [
			'email'   => 'required|email',
			'message' => 'required|max:255',
    	]);


		$data    = $request->all();
		$msg     = $data['message'];

    	Mail::send('emails.contact', compact('msg'), function($m) use($data) {

    		$m->from($data['email'], '[app web]');
    		$m->to(env('EMAIL_TECHN'), 'admin')->subject('Contact app web');

    	});

    	return redirect('contact')->with([
    		'message' => "message envoyé !",
    		'alert'   => 'success',
    	]);
    }

    public function dashboard(){

		return view('front.dashboard');
    }
}
