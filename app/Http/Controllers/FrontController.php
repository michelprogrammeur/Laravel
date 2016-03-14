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
            Cache::put('products', $products, env('TIME_CACHE', 5)); 
        }

    	return view('front.index', compact('products'));
    }

    public function show($id, $slug=''){
    	$product = Product::find($id);

    	return view('front.show', compact('product'));

    }

    public function showProductByCategory($id, $slug='', Request $request){
        
        $pageId = $request->get('page') ? $request->get('page') : '';
        $key = $request->path().$pageId; // uri

        //dd($key);

        $category = Category::findOrFail($id);
        $title = $category->title;
        //$products = Category::find($id)->products;

        if (Cache::has($key)) {
            $products = Cache::get($key);
        }else {
            $products = $category->products()->with('tags', 'category', 'picture')->paginate(5);

            Cache::put($key, $products, env('TIME_CACHE', 5));
        }


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
