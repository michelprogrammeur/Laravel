<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cart\Cart;
use App\History;
use App\Product;

class CartController extends Controller
{
	public function __construct(Cart $cart)
    {
        parent::__construct();

        $this->cart = $cart;
    }

    // ajouter un produit dans le panier
    public function postCommand(Request $request)
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

    // envoi de la commande 
    public function postStore(Request $request) {

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

    public function total() {
        $this->cart->total();
    }

    // reset tout les produits du panier
    public function getReset() {
        $this->cart->reset();

        return back();
    }

    // retire un produit du panier
    public function getRestore($id) {
        $this->cart->restore($id);

        return redirect('cart/cart')->with('message', 'product restore');
    }

    // voir les produits dans le panier
    public function getCart() {
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

    
}
