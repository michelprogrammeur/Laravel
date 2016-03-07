@if(Session::has('message'))

	<div class="alert-message" {{Session::get('alert')}}>
		<p {{Session::get('message')}}></p>
	</div>

@endif