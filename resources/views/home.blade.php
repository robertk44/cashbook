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
                    <div style="min-height: 30px;">
                        @if ($cashbox->description)
                            <p class="card-text">{{ $cashbox->description }}</p>
                        @endif
                    </div>
                    <hr>
                    @php $isEven = true; @endphp
                    @foreach ($cashbox->bookings as $booking)
                        <div class="d-flex {{ $isEven ? 'bg-light' : 'bg-white' }}">
                            <div class="cb-flex-0-auto cb-w-90">
                                <strong>{{ $booking->booking_date->format('d.m.Y') }}</strong>
                            </div>
                            <div class="flex-grow-1 px-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        {{ $booking->description }}
                                    </div>
                                    <div>
                                        @if ($booking->category)
                                            <span class="badge text-bg-secondary">{{ $booking->category->name }}</span>
                                        @endif
                                    </div>
                                </div>
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
                <div class="card-footer">
                    <div class="text-end">
                        @auth
                            <a href="{{ route('cashboxes.bookings.create', ['cashbox' => $cashbox]) }}" class="btn btn-outline-primary"><i class="bi bi-plus-slash-minus pe-3"></i>Neue Buchung</a>
                        @else
                            <p class="card-text text-end fs-5 fw-bold">Kontostand: @include('partials.numberCurrency', ['amount' => $cashbox->balance])</p>
                        @endauth
                    </div>
                    <h5 class="mt-2">Summe Ausgaben</h5>
                    @php $isFirstCategory = true; @endphp
                    @foreach ($categories as $category)
                        <div class="d-flex justify-content-between {{ $isFirstCategory ? '' : 'border-top' }}">
                            <div class="fw-bold">
                                {{ $category['name'] }}
                            </div>
                            <div class="fw-bold">
                                @if (isset($outgoings[$cashbox->id][$category['id']]))
                                    @include('partials.numberCurrency', ['amount' => ($outgoings[$cashbox->id][$category['id']] * -1), 'colored' => false])
                                @else
                                    @include('partials.numberCurrency', ['amount' => 0, 'colored' => false])
                                @endif
                            </div>
                        </div>
                        @php $isFirstCategory = false; @endphp
                    @endforeach
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
