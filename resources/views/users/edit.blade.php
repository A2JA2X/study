@extends('layout')

@section('content')
    <h1>Edit user</h1>

    <hr>

    @if($errors->any())
        <div class="alert alert-danger">
            <h2>Please fix errors</h2>
        </div>
    @endif
    <form method="POST" action="{{ url("users/{$user->id}") }}">
        {{ method_field('PUT')  }}
        {{ csrf_field() }}

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
        @if ($errors->has('name'))
            <p>{{ $errors->first('name') }}</p>
        @endif

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
        @if ($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
        @endif

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

        <input type="submit" class="btn btn-primary" value="Update">
    </form>
    <p>
        <a href="{{ route('users') }}">Home</a>
    </p>
@endsection