@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="email">E-Mail:</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required>
            @error('email') <div>{{ $message }}</div> @enderror
        </div>
        <div>
            <label for="password">Passwort:</label>
            <input id="password" name="password" type="password" required>
            @error('password') <div>{{ $message }}</div> @enderror
        </div>
        <button type="submit">Registrieren</button>
    </form>
@endsection
