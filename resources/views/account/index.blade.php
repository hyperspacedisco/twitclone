@extends('master')

@section('title', 'Profile')

@section('meta-description', 'Users profile page. Customise it to show what you like.')

@section('content')
{{-- says hello to the user logged in --}}
<h1>Hi there {{ \Auth::user()->name }}</h1>

<h3>Account Stats</h3>
<ul>
	<li>{{ $totalTweets }} total tweets.</li>
</ul>

<h3>Write a new Tweet</h3>

<form action=" /account/new-tweet" method="post">
	{!! csrf_field() !!}
	<div>

		<label for="content">Tweet: </label>
		<textarea id="content" name="content" cols="30" rows="10">{{ old('content') }}</textarea>
	</div>
	<input type="submit" value="Create Tweet">

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