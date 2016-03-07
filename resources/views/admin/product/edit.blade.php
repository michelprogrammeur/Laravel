@extends('layouts.admin')

@section('content')
	<form enctype="multipart/form-data" method="post" action="{{url('product', $product->id)}}">
		{{csrf_field()}}
		{{method_field('PUT')}}
		<input type="text" name="title" value="{{$product->title}}"  placeholder="Nom du produit"/>	
		<input type="text" name="slug" value="{{$product->slug}}" placeholder="url référencement"/>
		<input type="number" step="any" name="price" value="{{$product->price}}"  placeholder="Prix du produit"/>
		<input type="number" name="quantity" value="{{$product->quantity}}" placeholder="0"/>


		<textarea name="abstract">{{$product->abstract}}</textarea>
		<textarea name="description">{{$product->content}}</textarea>


		<label>Categories</label>
		<select name="category_id">
			@foreach($categories as $id=>$title)
	    		<option value="{{$id}}" {{$product->category_id==$id? 'selected': ''}}>{{ $title }}</option>
			@endforeach
			<option value="0" {{is_null($product->category_id)? 'selected': ''}}>Non catégorisé</option>
		</select>


		<label>Tags</label>
		<select name="tag_id[]" multiple>
			@foreach($tags as $id=>$name)
	    		<option value="{{$id}}" {{$product->hasTag($id)? 'selected': ''}}>{{$name}}</option>
			@endforeach
		</select>


		<h2>Mettre en ligne un produit</h2>
		<label>published</label>
		<input type="radio" name="status" value="published" />
		<label>unpublished</label>
		<input type="radio" name="status" value="unpublished" checked="checked" />

		<h2>Mettre une image</h2>
		@if(!is_null($product->picture))
			<img src="{{url('uploads', $product->picture->uri )}}" ></a>
			<label>Supprimer l'image ?</label>
			<input type="radio" name="deletePicture" value="true" />
		@endif
		<input type="file" name="picture">

		<input type="submit" value="valider"/>
	</form>
@stop