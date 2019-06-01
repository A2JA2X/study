@extends('layout')

@section('content')
    <h1>{{ $title }}</h1>

    <hr>

    @if($errors->any())
        <div class="alert alert-danger">
            <h5>Please fix errors</h5>
        </div>
    @endif
    <form method="POST" action="{{ url('users/create') }}">
        {{ csrf_field() }}

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @if ($errors->has('name'))
            <p>{{ $errors->first('name') }}</p>
        @endif

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
        @if ($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
        @endif

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

        <input type="submit" class="btn btn-primary" value="Create">
    </form>
    <p>
        <a href="{{ route('users') }}">Home</a>
    </p>
@endsection