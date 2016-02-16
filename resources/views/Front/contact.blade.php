@extends('layouts.master')


@section('content')
	<form name="form" action="{{url('send')}}" method="post" >
		{{csrf_field()}}
		<label>Email:</label>
		<input name="email" type="mail" placeolder="votre mail" value="{{old('email')}}">
		@if($errors->has('email')) 
			<span class="error">{{$errors->first('email')}}</span>
		@endif

		<label>Message:</label>
		<textarea name="message" value="{{old('message')}}"></textarea>

		<input type="submit" value="Envoyer">

		@if(Session::has('message'))
			<span class="warming {{Session::get('alert')}}"> {{Session::get('message')}}</span>
			
		@endif
	</form>
@stop