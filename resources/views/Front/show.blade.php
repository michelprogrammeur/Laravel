@extends('layouts.master')

@section('content')

<section class="showProduct">
	<h2 class="showProductTitle">{{ $product->title }}</h2>
	<div>
		@if($url = $product->picture)
			<img class="showProductImage" src="{{url('uploads', $url->uri )}}" >
		@endif

		<form class="option-commande" method="post" action="{{url('cart/command')}}">
			{{csrf_field()}}
			<p class="showProductQuantity">Stock:{{ $product->quantity }}</p>

			<input type="hidden" value="{{$product->id}}" name="id">
			<input type="hidden" value="{{$product->price}}" name="price">

			<p class="showProductTitleSelect">Votre quantité</p>
			<select class="showProductSelect" name="quantity">
				@for($i = 1; $i < $product->quantity + 1; $i++)
					<option>{{$i}}</option>
				@endfor
			</select>
			<input class="showProductBtnSubmit" type="submit" value="Ajouter au panier">
		</form>

		<p class="showProductAbs">{{ $product->abstract }}</p>

		@if(isset($product->category))
			<p class="showProductCategory">{{ $product->category->title }}</p>
		@endif

		@forelse ($product->tags as $tag)
	    	<span class="showProductTags">{{ $tag->name }}</span>
		@empty
		<p>no tags</p>
		@endforelse
	</div>

	

	<p class="showProductPrice">{{ $product->price }} €</p>
</section>
@stop

