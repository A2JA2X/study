@extends('layout')

@section('title', 'User list')

@section('content')
    <h1>{{ $title }}</h1>

    <hr>
    <ul>
        @forelse ($users as $user)
            <li>
                {{ $user->name }}, {{ $user->email }}
                <a href="{{ route('users.show', ['id' => $user->id]) }}">Show details</a>
            </li>
        @empty
            <p>No users.</p>
        @endforelse
    </ul>
@endsection

@section('sidebar')
    <h2>Side for users</h2>
@endsection