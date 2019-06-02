@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>{{ $title }}</h1>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    Please fix errors
                </div>
            @endif
            <form method="POST" action="{{ url('users/create') }}" class="mb-3">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="InputName">Name</label>
                    @if ($errors->has('name'))
                        <input type="text" class="form-control is-invalid" id="InputName" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                    @else
                        <input type="text" class="form-control" id="InputName" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                    @endif
                </div>

                <div class="form-group">
                    <label for="InputEmail">Email address</label>
                    @if ($errors->has('email'))
                        <input type="email" class="form-control is-invalid" id="InputEmail" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @else
                        <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="InputPass">Password</label>
                    @if ($errors->has('password'))
                        <input type="password" class="form-control is-invalid" id="InputPass" name="password" placeholder="Password">
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                    @else
                        <input type="password" class="form-control" id="InputPass" name="password" placeholder="Password">
                    @endif
                </div>

                <input type="submit" class="btn btn-primary" value="Create">
            </form>
            <p>
                <a href="{{ route('users') }}">Return to users</a>
            </p>
        </div>
    </div>
@endsection