TOM
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Login</h2>

    <form action="{{ route('login.attempt') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
            >

            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Password</label>

            <input
                type="password"
                name="password"
                class="form-control"
            >

            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Login
        </button>

    </form>

</div>

@endsection
