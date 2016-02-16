@extends('layouts.master')


@section('content')
	<form name="form" action="{{url('login')}}" method="post" >
		{{csrf_field()}}
		<label>Email:</label>
		<input name="email" type="mail" placeolder="votre mail" value="{{old('email')}}">

		@if($errors->has('email')) 
			<span class="error">{{$errors->first('email')}}</span>
		@endif

		<label>Mot de passe:</label>
		<input name="password" type="text" placeolder="votre mail" value="{{old('password')}}">

		<label>Se souvenir de moi:</label>
		<<input name="remember" type="radio" value="remember">

		<input type="submit" value="Envoyer">

		@if(Session::has('password'))
			<span class="warming {{Session::get('alert')}}"> {{Session::get('message')}}</span>
			
		@endif
	</form>
@stop