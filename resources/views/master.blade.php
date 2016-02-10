<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title') : TwitClone</title>
	<meta name="description" content="@yield('meta-description')">
</head>
<body>

<nav>
	<ul>
		<li><a href="/">Home</a></li>
		<li><a href="/contact">Contact</a></li>
	{{-- check to see if the user is logged in. will change nav depending on login status--}}
		@if(\Auth::check())
		<li><a href="/logout">Logout</a></li>
		<li><a href="/profile">Profile</a></li>
		@else
		<li><a href="/register">Register with us</a></li>
		<li><a href="/login">Login</a></li>
		
		@endif
	</ul>
</nav>

	@yield('content')


</body>
</html>