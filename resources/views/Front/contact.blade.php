@extends('layouts.master')





@section('content')
	<form class="contactFormulaire" name="form" action="{{url('send')}}" method="post" >
		{{csrf_field()}}

		<h2>Contact</h2>
		<span class="input input--hoshi">
			<input name="email" class="input__field input__field--hoshi" type="email" id="input-4" value="{{old('email')}}"/>
			<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
				<span class="input__label-content input__label-content--hoshi">Email</span>
			</label>
		</span>

		@if($errors->has('email')) 
			<span class="error">{{$errors->first('email')}}</span>
		@endif

		<label class="contactLabel">Message:</label>
		<textarea class="contactTextarea" name="message" value="{{old('message')}}"></textarea>

		<input class="contactBtnSumit" type="submit" value="Envoyer">

		@if(Session::has('message'))
			<span class="warming {{Session::get('alert')}}"> {{Session::get('message')}}</span>
			
		@endif
	</form>
@stop




				
