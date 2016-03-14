<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Panier Laravel</title>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{url('assets/css/set1.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('assets/css/knacss.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('assets/css/app.min.css')}}">

</head>

<body>

	<header  id="header">
		@include('partials.nav')
	</header>

	

	<div id="main">
		<div class="grid-2">
			<div class="sidebar content">
				@section('sidebar')
					<h2 class="sidebarTitle">Best Product</h2>
				@show
				<!-- SIDEBAR -->
			</div>
			<div class="product content">
				@yield('content')  <!-- blade -->
			</div>
		</div>
	</div>

	<footer>
	</footer>

	@yield('scripts');
	
</body>
</html>