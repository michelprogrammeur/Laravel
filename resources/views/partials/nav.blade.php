

<ul class="navbar">

@forelse($categories as $category)
	<li><a class="hvr-fade" href="{{url('cat', [$category->id, $category->slug])}}">{{$category->title}}</a></li>
@empty

@endforelse

	<li><a class="hvr-fade" href="{{url('contact')}}">Contact</a></li>

@if(Auth::check())

	<li><a class="hvr-fade" href="{{url('product')}}">Dashboard</a></li>
	<li><a class="hvr-fade" href="{{url('logout')}}">Logout</a></li>

@else 
	<li><a class="hvr-fade" href="{{url('login')}}">Login</a></li>
@endif

	<li><a class="hvr-fade" href="{{url('cart/cart')}}">Panier</a></li>

@if (Session::has('cart')) 
	<li><a  href="{{url('cart/cart')}}"><span class="cartIcone"></span>{{count(Session::get('cart'))}}</a></li>
@endif
</ul>

