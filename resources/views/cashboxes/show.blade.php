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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Beschreibung</th>
                        <th>Betrag</th>
                        <th>Beleg</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cashbox->bookings as $booking)
                        <tr>
                            <td>{{ $booking->booking_date->format('d.m.Y') }}</td>
                            <td>{{ $booking->description }}</td>
                            <td class="{{ $booking->amount >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ number_format($booking->amount, 2) }} €
                            </td>
                            <td>
                                @if ($booking->receipt_image)
                                    <a href="{{ asset('storage/' . $booking->receipt_image) }}" target="_blank">Ansehen</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
