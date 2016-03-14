@extends('layouts.master')

@section('content')
<form class="form-panier" method="POST" action="{{url('cart/store')}}">
    {{csrf_field()}}
    <ul>
        @forelse($products as $product)
        <div class="showCartProduct">
            <input type="hidden" name="product_id[]" value="{{$product['id']}}" />
            <input type="hidden" name="quantity{{$product['id']}}" value="{{$product['quantity']}}" />

            <li class="titleProduct">{{$product['name']}}</li>
            <li class="price">{{$product['price']}} €</li> 
            <li><p class="quantity">Qts: {{$product['quantity']}}</p></li>
            <li class="showCartProductTotalOnePdt">{{$product['total']}} €</li> 
            <li>
                <label for="reset{{$product['id']}}"></label>
                <a class="showCartProductDltOne" href="{{url('cart/restore', $product['id'])}}"><i class="fa fa-times"></i></a>
            </li>
        </div>             
        @empty
        @endforelse
    </ul>
    <div class="form-submit">
        @if(!empty($products))
            <div>
                <p><span class="total">Total: {{$total}} €</span></p>
                <a href="{{url('cart/reset')}}" class="deleteAllProducts" >supprimer tout les produits</a>
            </div>
            <input class="showCartProductBtnSumit" name="submit" type="submit" value="Valider le panier">
        @else
            <p class="showCartProductMsgEmpty">Votre panier en vide !</p>
        @endif
        
    </div>
</form>
@stop