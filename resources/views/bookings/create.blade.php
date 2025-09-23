@extends('layouts.app')

@section('title', 'Neue Buchung')

@section('content')
    <livewire:booking-form :cashbox="$cashbox" />
@endsection
