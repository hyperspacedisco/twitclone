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
		<li><a href="/register">Register with us</a></li>
		<li><a href="/login">Login</a></li>
	</ul>
</nav>

	@yield('content')


</body>
</html>