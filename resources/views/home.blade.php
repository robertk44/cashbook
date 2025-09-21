@extends('layouts.app')

@section('title', 'Startseite')

@section('content')
<div class="row mt-5">
    @foreach ($cashboxes as $cashbox)
        <div class="col col-12 col-lg-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    <h5 class="card-title">{{ $cashbox->name }}</h5>
                </div>
                <div class="card-body">
                    @if ($cashbox->description)
                        <p class="card-text">{{ $cashbox->description }}</p>
                        <hr>
                    @endif
                    @foreach ($cashbox->bookings->sortBy('booking_date') as $booking)
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong>{{ $booking->booking_date->format('d.m.Y') }}</strong>
                            </div>
                            <div>
                                {{ $booking->description }}
                            </div>
                            <div>
                                {{ number_format($booking->amount, 2, ',', '.') }} €
                            </div>
                        </div>
                    @endforeach
                    @auth
                        <hr>
                        <p class="card-text text-end"><strong>Kontostand:</strong> {{ number_format($cashbox->balance, 2, ',', '.') }} €</p>
                    @endauth
                </div>
                <div class="card-footer text-end">
                    @auth
                        <a href="{{ route('cashboxes.bookings.create', ['cashbox' => $cashbox]) }}" class="btn btn-outline-primary"><i class="bi bi-plus-slash-minus pe-3"></i>Neue Buchung</a>
                    @else
                        <p class="card-text text-end fs-5"><strong>Kontostand:</strong> {{ number_format($cashbox->balance, 2, ',', '.') }} €</p>
                    @endauth
                </div>
            </div>
        </div>
    @endforeach
</div>
@auth
<div class="row mt-4">
    <div class="col">
        <a href="{{ route('cashboxes.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle pe-3"></i>Neue Kasse erstellen</a>
    </div>
</div>
@endauth
@endsection
