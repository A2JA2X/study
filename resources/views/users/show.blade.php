@extends('layout')

@section('title', "User {$user->id}")

@section('content')
    <h1>{{ $title }}</h1>

    <hr>
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>
        <a href="{{ route('users') }}">Home</a>
    </p>
@endsection

@section('sidebar')
    @parent
    <h2>Side down</h2>
@endsection