@extends('master')

@section('title', 'Register')
@section('meta-description', 'Register with us to start sharing your thoughts')

@section('content')

<h1>Register With Us</h1>

<form action="/register" method="post">

	{!! csrf_field() !!}

	<div>
		<label for="name">Full Name: </label>
		<input type="text" name="name" id="name" placeholder="Elton John">
	</div>

	<div>
		<label for="email">Email Address: </label>
		<input type="email" name="email" id="email" placeholder="name@email.com">
	</div>

	<div>
		<label for="password">Password: </label>
		<input type="password" name="password" id="password">
	</div>

	<div>
		<label for="password_confirmation">Confirm Password: </label>
		<input type="password" name="password_confirmation" id="password_confirmation">
	</div>

	<input type="submit" value="Register">
</form>

{{-- display errors --}}

@if(count($errors))
<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>	
@endif
@endsection