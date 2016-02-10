@extends('master')

@section('title', 'Profile')

@section('meta-description', 'Users profile page. Customise it to show what you like.')

@section('content')
{{-- says hello to the user logged in --}}
<h1>Hi there {{ \Auth::user()->name }}</h1>

@endsection