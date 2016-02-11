@extends('master')

@section('title', 'profile page')



@section('meta-description', 'Users profile page.')

@section('content')

<header id="user-profile">
	<img src="" alt="" width="120" height="120">
	<h1>{{ $user->name }}</h1>
	<p>{{ $user->description }}</p>
	<ul>
		<li>Total tweets: {{ $user->tweets->count() }}</li>
		<li></li>
		<li></li>
	</ul>
</header>

{{-- show tweets --}}
@foreach( $userPosts as $tweet)

	<article class="tweet">
		<hr />
		<p>{{ $tweet->content }}</p>
		<p><small>Posted: {{ $tweet->created_at }} by {{ $tweet->user->name }}</small></p>
		<p><small>{{ $tweet->likes }} likes.</small></p>

		{{-- show associated comments --}}
		<h4>Comments: </h4>

			@if($tweet->comments->count() == 0)

				<article class="comment">
					<p><em>Be the first to reply to this tweet!</em></p>
				</article>

			@else
				@foreach($tweet->comments as $comment)
					<article class="comment">
						<p><em>{{$comment->user->name}}</em>: {{ $comment->content }}</p>
					</article>
				@endforeach
			@endif

		<hr />
</article>

@endforeach

@endsection