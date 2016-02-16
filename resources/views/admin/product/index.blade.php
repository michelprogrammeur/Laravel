@extends('layouts.admin')

@section('content')
	<p><a href="{{ url('product/create') }}">Create product</a></p>

	{!! $products->links() !!}

	<table>
		<tr class="titles-cell">
	        <td>status</td>
	        <td>name</td>
	        <td>price</td>
	        <td>quantity</td>
	        <td>date</td>
	        <td>category</td>
	        <td>tags</td>
	        <td>action</td>
    	</tr>

    	
	    @foreach($products as $product)
	        <tr class="titles-cell">
	        	<td>{{ $product->status }}</td>
	        	<td>{{ $product->title }}</td>
	        	<td>{{ $product->price }} €</td>
	        	<td>{{ $product->quantity }}</td>
	        	<td>{{ $product->published_at }}</td>
	        	<td>{{ ($cat=$product->category)? $cat->title : 'no category' }}</td>
	        	<td>
	        		<ul>
			        	@forelse ($product->tags as $tag)
				    		<li>{{ $tag->name }}</li>
						@empty
							<li>No tags</li>
						@endforelse
					</ul>
				</td>
	        	<td>
	        		<form methode="post" action="{{ url('product', $product->id) }}">
	        			{{ method_field('DELETE') }} <!--champ hidden _method value DELETE -->

	        			{{ csrf_field() }}
	        			<input class="delete" type="submit" value="Delete" />
	        		</form>
	        	</td>
			</tr>
	    @endforeach
    	
	</table>

@stop



	