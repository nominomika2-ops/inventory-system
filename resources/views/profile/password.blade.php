
@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

<div class="container mt-4">

    <h2>Change Password</h2>

    <div class="card p-4 mt-3">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.password.update') }}">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Current Password</label>

                <input type="password"
                       name="current_password"
                       class="form-control">

                @error('current_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">New Password</label>

                <input type="password"
                       name="password"
                       class="form-control">

                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm New Password</label>

                <input type="password"
                       name="password_confirmation"
                       class="form-control">
            </div>

            <button type="submit" class="btn btn-success">
                Update Password
            </button>

            <a href="{{ route('profile') }}" class="btn btn-secondary">
                Back to Profile
            </a>

        </form>

    </div>

</div>

@endsection
