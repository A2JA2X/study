@extends('layout')

@section('title', 'User list')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-2">
        <h1 class="pb-1">{{ $title }}</h1>
        <p>
            <a href="{{ route('users.new') }}" class="btn btn-primary">New user</a>
        </p>
    </div>

    <hr>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            {{ method_field('DELETE')  }}
                            {{ csrf_field() }}
                            <a href="{{ route('users.show', $user) }}" class="btn btn-link">Show details</a>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-link">Edit</a>
                            <input type="submit" class="btn btn-link text-danger" value="Delete">
                        </form>
                    </td>
                </tr>
            @empty
                <p>No users.</p>
            @endforelse
        </tbody>
    </table>
    {{ $users->links('vendor.pagination.bootstrap-4') }}
@endsection

@section('sidebar')
    Side
@endsection