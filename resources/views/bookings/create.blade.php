@extends('layouts.app')

@section('title', 'Neue Buchung')

@section('content')
<div class="row mt-5">
    <div class="col">
        <h1>{{ $cashbox->name }}<span class="text-tertiary"> | Neue Buchung</span></h1>
        <form action="{{ route('cashboxes.bookings.store', ['cashbox' => $cashbox]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="booking_date" class="form-label">Datum</label>
                <input type="date" class="form-control @error('booking_date') is-invalid @enderror" id="booking_date" name="booking_date" required value="{{ old('booking_date', date('Y-m-d')) }}">
                @error('booking_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Kommentar</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" required value="{{ old('description') }}">
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Betrag</label>
                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" step="0.01" value="{{ old('amount', 0) }}">
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
    </div>
</div>
@endsection
