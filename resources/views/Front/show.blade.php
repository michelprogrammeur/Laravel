@extends('layouts.master')

@section('content')

	<h2>{{ $product->title }}</h2>
	<p>{{ $product->abstract }}</p>
	<div>
		@if($url = $product->picture)
			<img src="{{url('uploads', $url->uri )}}" >
		@endif
		
		<p>{{ $product->price }}</p>
		<p>{{ $product->quantity }}</p>

		@if(isset($product->category))
			<p>{{ $product->category->title }}</p>
		@endif

		@forelse ($product->tags as $tag)
	    	<span>{{ $tag->name }}</span>
		@empty
		<p>no tags</p>
		@endforelse
	</div>

	<form class="option-commande" method="post" action="{{url('command')}}">

		{{csrf_field()}}

		<input type="hidden" value="{{$product->id}}" name="id">
		<input type="hidden" value="{{$product->price}}" name="price">

		<p>Votre quantité</p>
		<select name="quantity">
			@for($i = 0; $i < $product->quantity + 1; $i++)
				<option>{{$i}}</option>
			@endfor
		</select>
		<input type="submit" value="Ajouter au panier">
	</form>
@stop