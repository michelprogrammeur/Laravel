@extends('layouts.master')

@section('content')
	<form class="loginFormulaire" name="form" action="{{url('login')}}" method="post" >
		{{csrf_field()}}
		<h2>Login</h2>
		<span class="input input--hoshi">
			<input name="email" class="input__field input__field--hoshi" type="email" id="input-4" value="{{old('email')}}"/>
			<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
				<span class="input__label-content input__label-content--hoshi">Email</span>
			</label>
		</span>

		@if($errors->has('email')) 
			<span class="error">{{$errors->first('email')}}</span>
		@endif

		<span class="input input--hoshi">
			<input name="password" class="input__field input__field--hoshi" type="text" id="input-4" value="{{old('password')}}"/>
			<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
				<span class="input__label-content input__label-content--hoshi">Password</span>
			</label>
		</span>

		<label class="loginRememberTitle">Se souvenir de moi:</label>
		<input class="loginRememberRadio" name="remember" type="radio" value="remember">

		<input class="loginBtnSumit" type="submit" value="Envoyer">

		@if(Session::has('password'))
			<span class="warming {{Session::get('alert')}}"> {{Session::get('message')}}</span>
		@endif
	</form>
@stop