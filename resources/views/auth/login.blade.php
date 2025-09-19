@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label>E-Mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email') <div>{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Passwort</label>
            <input type="password" name="password" required>
            @error('password') <div>{{ $message }}</div> @enderror
        </div>
        <button type="submit">Login</button>
    </form>
@endsection
