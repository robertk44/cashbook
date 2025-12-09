@extends('layouts.app')

@section('title', $cashbox->name)

@section('content')
<div class="row mt-5">
    <div class="col">
        <h1>{{ $cashbox->name }}</h1>
        <p>{{ $cashbox->description }}</p>
        <p><strong>Guthaben:</strong> {{ number_format($cashbox->balance, 2) }} €</p>
        <a href="{{ route('cashboxes.bookings.create', ['cashbox' => $cashbox->id]) }}" class="btn btn-primary mb-4"><i class="bi bi-plus-slash-minus pe-3"></i>Neue Buchung</a>

        <h2>Buchungen</h2>
        @if ($cashbox->bookings->isEmpty())
            <p>Keine Buchungen vorhanden.</p>
        @else
            <div class="cb-table">
                <div class="cb-table__row cb-table__row--header">
                    <div class="cb-table__col cb-table__col--date">Datum</div>
                    <div class="cb-table__col cb-table__col--desc">Beschreibung</div>
                    <div class="cb-table__col cb-table__col--cat">Kategorie</div>
                    <div class="cb-table__col cb-table__col--amount">Betrag</div>
                    <div class="cb-table__col cb-table__col--receipt">Beleg</div>
                </div>
                @foreach ($cashbox->bookings as $booking)
                    <div class="cb-table__row cb-table__row--item {{ $loop->even ? 'cb-table__row--even' : 'cb-table__row--odd' }}">
                        <div class="cb-table__col cb-table__col--date cb-table__col--link">
                            <a href="{{ route('bookings.show', ['booking' => $booking]) }}" class="cb-table__link">{{ $booking->booking_date->format('d.m.Y') }}</a>
                        </div>
                        <div class="cb-table__col cb-table__col--desc cb-table__col--link">
                            <a href="{{ route('bookings.show', ['booking' => $booking]) }}" class="cb-table__link">{{ $booking->description }}</a>
                        </div>
                        <div class="cb-table__col cb-table__col--cat">
                            @if ($booking->category)
                                <span class="badge text-bg-secondary">{{ $booking->category->name }}</span>
                            @endif
                        </div>
                        <div class="cb-table__col cb-table__col--amount {{ $booking->amount >= 0 ? 'text-success' : 'text-danger' }}">
                            {{ number_format($booking->amount, 2) }} €
                        </div>
                        <div class="cb-table__col cb-table__col--receipt">
                            @if ($booking->receipt_image)
                                <a href="{{ asset('storage/' . $booking->receipt_image) }}" target="_blank">Ansehen</a>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
