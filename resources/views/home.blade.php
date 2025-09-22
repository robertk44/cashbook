@extends('layouts.app')

@section('title', 'Startseite')

@section('content')
<div class="row mt-5">
    @foreach ($cashboxes as $cashbox)
        <div class="col col-12 col-lg-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    <h5 class="card-title"><a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="{{ route('cashboxes.show', ['cashbox' => $cashbox]) }}">{{ $cashbox->name }}</a></h5>
                </div>
                <div class="card-body">
                    @if ($cashbox->description)
                        <p class="card-text">{{ $cashbox->description }}</p>
                        <hr>
                    @endif
                    @php $isEven = true; @endphp
                    @foreach ($cashbox->bookings->sortBy([['booking_date', 'asc'], ['id', 'asc']]) as $booking)
                        <div class="d-flex {{ $isEven ? 'bg-light' : 'bg-white' }}">
                            <div class="cb-flex-0-auto cb-w-90">
                                <strong>{{ $booking->booking_date->format('d.m.Y') }}</strong>
                            </div>
                            <div class="flex-grow-1 px-3">
                                {{ $booking->description }}
                            </div>
                            <div class="fw-bold text-end cb-flex-0-auto cb-w-90">
                                @include('partials.numberCurrency', ['amount' => $booking->amount])
                            </div>
                        </div>
                        @php $isEven = !$isEven; @endphp
                    @endforeach
                    @auth
                        <hr>
                        <p class="card-text text-end fw-bold">Kontostand: @include('partials.numberCurrency', ['amount' => $cashbox->balance])</p>
                    @endauth
                </div>
                <div class="card-footer text-end">
                    @auth
                        <a href="{{ route('cashboxes.bookings.create', ['cashbox' => $cashbox]) }}" class="btn btn-outline-primary"><i class="bi bi-plus-slash-minus pe-3"></i>Neue Buchung</a>
                    @else
                        <p class="card-text text-end fs-5 fw-bold">Kontostand: @include('partials.numberCurrency', ['amount' => $cashbox->balance])</p>
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
