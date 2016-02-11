@extends('master')

@section('title', 'confirm tweet delete')



@section('meta-description', 'Confirm the delete of the tweet')

@section('content')

<h1>Are you sure you want to delete this tweet?</h1>

<p>Doing so will delete the tweet permanently, and will not be able to be retrieved again in the future if you change your mind.</p>

<article class="tweet">
	<p>{{ $tweet->content }}</p>
	<p><small>written by {{$tweet->user->name}} on {{ $tweet->created_at }}</small></p>
</article>

| <a href="/profile/delete-tweet/{{ $tweet->id}}/confirm">Yes</a> || <a href="/profile/{{$tweet->user->username}}">No (this will redirect you to the previous page)</a> |
@endsection