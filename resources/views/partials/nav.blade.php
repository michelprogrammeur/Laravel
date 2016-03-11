

<ul class="navbar">

@forelse($categories as $category)
	<li><a href="{{url('cat', [$category->id, $category->slug])}}">{{$category->title}}</a></li>
@empty

@endforelse

	<li><a href="{{url('contact')}}">Contact</a></li>

@if(Auth::check())

	<li><a href="{{url('product')}}">Dashboard</a></li>
	<li><a href="{{url('logout')}}">Logout</a></li>

@else 
	<li><a href="{{url('login')}}">Login</a></li>
@endif

	<li><a href="{{url('cart')}}">Panier</a></li>
</ul>