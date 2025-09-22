@extends('layouts.app')

@section('title', 'Neue Buchung')

@section('content')
<form action="{{ route('cashboxes.bookings.store', ['cashbox' => $cashbox]) }}" method="POST" enctype="multipart/form-data">
    <div class="row mt-5">
        <div class="col col-12">
            <h1>{{ $cashbox->name }}<span class="text-tertiary"> | Neue Buchung</span></h1>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-xl-6">
            @csrf
            <div class="mb-3">
                <label for="booking_date" class="form-label">Datum</label>
                <input type="date" class="form-control @error('booking_date') is-invalid @enderror" id="booking_date" name="booking_date" required value="{{ old('booking_date', date('Y-m-d')) }}">
                @error('booking_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-xl-6">
            <div class="mb-3">
                <label for="description" class="form-label">Kommentar</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" required value="{{ old('description') }}">
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-xl-6">
            <div class="mb-3">
                <label for="receipt_image" class="form-label">Belegbild</label>
                <input type="file" class="form-control @error('receipt_image') is-invalid @enderror" id="receipt_image" name="receipt_image" value="{{ old('receipt_image') }}">
                @error('receipt_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-sm-6 col-lg-4 col-xl-2">
            <div class="mb-3">
                <label class="form-label">Art</label><br />
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="amount_type" id="income" value="income" autocomplete="off" {{ (old('amount_type') == 'income' || old('amount_type') == null) ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="income">Einnahme</label>

                    <input type="radio" class="btn-check" name="amount_type" id="outgoing" value="outgoing" autocomplete="off" {{ old('amount_type') == 'outgoing' ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger" for="outgoing">Ausgabe</label>
                </div>
                @error('amount_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col col-12 col-sm-6 col-lg-4 col-xl-2">
            <div class="mb-3">
                <label for="amount" class="form-label">Betrag</label>
                <div class="input-group">
                    <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" step="0.01" value="{{ old('amount', 0) }}">
                    <span class="input-group-text">€</span>
                </div>
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col col-12">
            <button type="submit" class="btn btn-primary">Speichern</button>
        </div>
    </div>
</form>
@endsection
