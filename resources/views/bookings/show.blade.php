@extends('layouts.app')

@section('title', 'Buchung vom ' . $booking->booking_date->format('d.m.Y'))

@section('content')
<div class="row mt-5">
    <div class="col col-12">
        <h1>Buchung vom {{ $booking->booking_date->format('d.m.Y') }}</h1>
        <p><strong>Beschreibung:</strong> {{ $booking->description }}</p>
        <p><strong>Betrag:</strong>
            <span class="{{ $booking->amount >= 0 ? 'text-success' : 'text-danger' }}">
                {{ number_format($booking->amount, 2) }} €
            </span>
        </p>
        @if ($booking->category)
            <p><strong>Kategorie:</strong> {{ $booking->category->name }}</p>
        @endif
        @if ($booking->receipt_image)
            <p><strong>Belegbild:</strong> <a href="{{ asset('storage/' . $booking->receipt_image) }}" target="_blank">Ansehen</a></p>
        @endif
        <div class="d-flex justify-content-between">
            <div>
                <a href="{{ route('cashboxes.show', ['cashbox' => $booking->cashBox]) }}" class="btn btn-secondary mt-3">Zurück zur Kasse</a>
            </div>
            <div>
                <form action="{{ route('bookings.destroy', ['booking' => $booking]) }}" method="POST" onsubmit="return confirm('Möchten Sie diese Buchung wirklich löschen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3">Buchung löschen</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
