@extends('layouts.app')

@section('title', 'Neue Kategorie')

@section('content')
<div class="row mt-5">
    <div class="col">
        <h1>Neue Kategorie erstellen</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
    </div>
</div>
@endsection
