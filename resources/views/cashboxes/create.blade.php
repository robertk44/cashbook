@extends('layouts.app')

@section('title', 'Neue Kasse')

@section('content')
<div class="row mt-5">
    <div class="col">
        <h1>Neue Kasse erstellen</h1>
        <form action="{{ route('cashboxes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Beschreibung</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="balance" class="form-label">Guthaben</label>
                <input type="number" class="form-control @error('balance') is-invalid @enderror" id="balance" name="balance" step="0.01" value="{{ old('balance', 0) }}">
                @error('balance')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
    </div>
</div>
@endsection
