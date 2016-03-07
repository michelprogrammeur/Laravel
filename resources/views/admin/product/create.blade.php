@extends('layouts.admin')

@section('content')
	<form enctype="multipart/form-data" method="post" action="{{url('product')}}">
		{{ csrf_field() }}
		<input type="text" name="title" placeholder="Nom du produit"/>	
		<input type="text" name="slug" placeholder="url référencement"/>
		<input type="number" step="any" name="price" placeholder="Prix du produit"/>
		<input type="number" name="quantity" placeholder="0"/>


		<textarea name="abstract"></textarea>
		<textarea name="description"></textarea>


		<label>Categories</label>
		<select name="category_id">
			<option value="0">Non catégorisé</option>
			@foreach($categories as $id=>$title)
	    		<option value="{{$id}}">{{ $title }}</option>
			@endforeach
		</select>


		<label>Tags</label>
		<select name="tag_id[]" multiple>
			@foreach($tags as $id=>$name)
	    		<option value="{{$id}}">{{ $name }}</option>
			@endforeach
		</select>


		<label>Date de publication</label>
		<input type="checkbox" name="published_at" value="ok"/>


		<h2>Mettre en ligne un produit</h2>
		<label>published</label>
		<input type="radio" name="status" value="published" />
		<label>unpublished</label>
		<input type="radio" name="status" value="unpublished" checked="checked" />

		<h2>Mettre une image</h2>
		<input type="file" name="picture">

		<input type="submit" value="valider"/>
	</form>
@stop