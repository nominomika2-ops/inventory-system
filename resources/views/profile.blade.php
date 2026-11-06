
@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="container mt-4">

    <h2>My Profile</h2>

    <div class="card p-4 mt-3">

        <p>
            <strong>Name:</strong>
            {{ auth()->user()->name }}
        </p>

        <p>
            <strong>Email:</strong>
            {{ auth()->user()->email }}
        </p>

        <p>
            <strong>Role:</strong>
            {{ auth()->user()->role }}
        </p>

        <a href="{{ route('profile.password') }}"
           class="btn btn-primary mt-3">
            Change Password
        </a>

    </div>

</div>

@endsection
