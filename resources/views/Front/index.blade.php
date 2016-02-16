
@extends('layouts.master')

@section('sidebar')
	@parent
	<p>home page</p>
@stop

@section('content')
	@forelse($products as $product)

		<h2><a href="{{url('prod', [$product->id, $product->slug])}}">{{ $product->title }}</a></h2>
		<p>{{ $product->abstract }}</p>
		<div>
			@if($url = $product->picture)
				<a href="{{url('prod', [$product->id, $product->slug])}}"><img src="{{url('uploads', $url->uri )}}" ></a>
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

	@empty
	<p>No product</p>
	@endforelse

	{!! $products->links() !!}
@stop