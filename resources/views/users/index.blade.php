
@extends('layouts.app')

@section('title', 'Users List')

@section('content')

<div class="container">

    <h2>Users List</h2>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
        Add New User
    </a>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection
