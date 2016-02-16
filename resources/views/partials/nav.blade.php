@forelse($categories as $category)
	<a href="{{url('cat', [$category->id, $category->slug])}}">{{$category->title}}</a>
@empty

@endforelse

<a href="{{url('login')}}">Login</a>