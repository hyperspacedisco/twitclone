@extends('master')

@section('title', 'Login')
@section('meta-description', 'login to TwitClone')

@section('content')

<h1>Login</h1>

<form action="/login" method="post">

{!!  csrf_field() !!}

	<div>
		<label for="email">Email Address: </label>
		<input type="email" id="email" name="email" value="{{ old('email') }}">
	</div>

	<div>
		<label for="password-login">Password: </label>
		<input type="password" id="password-login" name="password" >
	</div>

	<input type="submit" value="submit">
	
</form>

{{-- display error messages --}}

@if(count($errors))
<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>	
	
@endif

@endsection