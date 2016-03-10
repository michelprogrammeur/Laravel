@extends('layouts.master')

@section('content')
    <ul class="showCartProduct">
        <div>
            @forelse($products as $id => $product)
                <li class="titleProduct">{{$product['name']}}</li>
                <li class="price">{{$product['price']}}</li> 
                <li><p class="quantity">Qts: {{$product['quantity']}}</p></li>
                <li>{{$product['total']}}</li> 
                <li>
                    <label for="reset{{$id}}"></label>
                    <a class="btn btn-danger" href="{{url('restore', $product['id'])}}">supprimer ce produit</a>
                </li>
            @empty
            @endforelse
        </div>
    </ul>
    <div class="form-submit">
        @if(!empty($products))
            <p><span class="total">Total: {{$total}}</span></p>
            <a href="{{url('reset')}}" class="deleteAllProducts" >supprimer tout les produits</a>
        @else
            <p>Votre panier en vide !</p>
        @endif
    </div>
@stop