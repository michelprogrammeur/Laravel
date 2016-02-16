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

@stop