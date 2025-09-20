@extends('layouts.app')

@section('title', 'Startseite')

@section('content')
<div class="row">
    @foreach ($cashboxes as $cashbox)
        <div class="col col-12 col-md-6 col-lg-4">

        </div>
    @endforeach
</div>
    <h2>Willkommen auf der Startseite!</h2>
    <p>Inhalt</p>
@endsection
