@extends('layouts.master')

@section('sidebar')
	@parent
	<p>home page</p>
@stop

@section('content')
	@forelse($products as $product)
	<div class="productCategory">
		<h2 class="titleCatProduct"><a href="{{url('prod', [$product->id, $product->slug])}}">{{ $product->title }}</a></h2>
		<span><a class="catIconeLoupe" href="{{url('prod', [$product->id, $product->slug])}}"><i class="icon-zoom-in"></i></a></span>

		@if($url = $product->picture)
			<a href="{{url('prod', [$product->id, $product->slug])}}"><img src="{{url('uploads', $url->uri )}}" ></a>
		@endif

		<div class="containerCatProduct">
			<p class="catProductAbstract">{{ $product->abstract }}</p>

			
			@if(isset($product->category))
				<p class="catProductCategory">{{ $product->category->title }}</p>
			@endif

			<p class="catProductTitleTags">Tags:</p>
			@forelse ($product->tags as $tag)
		    	<span class="catProductTags">{{ $tag->name }}</span>
			@empty
			<p>no tags</p>
			@endforelse


			<ul class="catProductContainer">
				<li class="catProductPrice"><span>{{ $product->price }} €</span></li><!--
			 --><li class="catProductQuantity">{{ $product->quantity }} quantité</li>
			</ul>
		</div>

	</div>
	@empty
	<p>No product</p>
	@endforelse
	{!! $products->links() !!}
@stop