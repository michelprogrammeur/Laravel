<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;

use App\Cart\Cart;
use Bar;
use App\History;

class FrontController extends Controller
{

    public function __construct(Cart $cart)
    {
        parent::__construct();

        $this->cart = $cart;

    }

    public function index() {

    	$products = Product::with('tags', 'picture', 'category')->paginate(10);

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
    	//dd($request->all());
		return view('front.dashboard');
    }

    public function storeProduct(Request $request)
    {
        $this->validate($request, [
            'id'       => 'required|integer',
            'quantity' => 'required|integer',
            'price'    => 'required|numeric',
            
        ]);
        $product = Product::find($request->input('id'));
        $this->cart->buy($product, $request->input('quantity'));

        return back();
    }

    public function reset() {
        $this->cart->reset();

        return back();
    }

    public function total() {
        $this->cart->total();
    }

    public function restoreProduct($id) {
        $this->cart->restore($id);

        return redirect('cart')->with('message', 'product restore');
    }

    public function showCart() {
        $cart = $this->cart->get();

        $products = [];

        foreach ($cart as $id => $total) {
            $p = Product::find($id);
            $products[] = [
                'id'       => $p->id,
                'name'     => $p->title, 
                'price'    => $p->price, 
                'quantity' => $p->quantity,
                'total'    => $total['total'],
            ];
        }

        $total = $this->cart->total();

        return view('front.cart', compact('products', 'total'));
    }   

    public function commandCart(Request $request) {

        $this->validate($request, [
            'product_id.*' => 'integer|required',
            'quantity.*'   => 'integer|required',
        ]);

        foreach($request->input('product_id') as $productId) {

            $quantity = $request->input('quantity'.$productId);
            $history = History::create([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);

            $stock = $history->product->quantity;

            if ($stock >= $quantity) {
                $history->product->quantity -= $quantity;
            }else {
                $history->product->quantity = 0;
            }
            $history->product->save();

            $this->cart->reset();

            return redirect('/')->with('message', 'success command');
        }
    }
}
