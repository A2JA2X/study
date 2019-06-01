@extends('layout')

@section('title', 'User list')

@section('content')
    <h1>{{ $title }}</h1>

    <hr>

    <ul>
        @forelse ($users as $user)
            <li>
                {{ $user->name }}, {{ $user->email }}
                <a href="{{ route('users.show', $user) }}">Show details</a> |
                <a href="{{ route('users.edit', $user) }}">Edit</a> |
                <form action="{{ route('users.destroy', $user) }}" method="POST">
                    {{ method_field('DELETE')  }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </li>
        @empty
            <p>No users.</p>
        @endforelse
    </ul>
@endsection

@section('sidebar')
    <h4>
        <a href="{{ route('users.new') }}">New user</a>
    </h4>
@endsection