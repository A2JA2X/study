@extends('layout')

@section('content')
    <h1>{{ $title }}</h1>

    <hr>
    <form method="POST" action="{{ url('users/create') }}">
        {{ csrf_field() }}

        <label for="name">Name:</label>
        <input type="text" name="name" id="name">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

        <input type="submit" class="btn btn-primary" value="Create">
    </form>
    <p>
        <a href="{{ route('users') }}">Home</a>
    </p>
@endsection