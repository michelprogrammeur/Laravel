@extends('layouts.master')

@section('content')
<form class="form-panier" method="POST" action="{{url('storeCommand')}}">
    {{csrf_field()}}
    <ul class="showCartProduct">
        <div>
            @forelse($products as $product)
                <input type="hidden" name="product_id[]" value="{{$product['id']}}" />
                <input type="hidden" name="quantity{{$product['id']}}" value="{{$product['quantity']}}" />

                <li class="titleProduct">{{$product['name']}}</li>
                <li class="price">{{$product['price']}}</li> 
                <li><p class="quantity">Qts: {{$product['quantity']}}</p></li>
                <li>{{$product['total']}}</li> 
                <li>
                    <label for="reset{{$product['id']}}"></label>
                    <a class="btn btn-danger" href="{{url('restore', $product['id'])}}">supprimer ce produit</a>
                </li>             
            @empty
            @endforelse
        </div>
    </ul>
    <div class="form-submit">
        @if(!empty($products))
            <p><span class="total">Total: {{$total}} €</span></p>
            <a href="{{url('reset')}}" class="deleteAllProducts" >supprimer tout les produits</a>
            <input name="submit" type="submit" value="Valider le panier">
        @else
            <p>Votre panier en vide !</p>
        @endif
        
    </div>
</form>
@stop