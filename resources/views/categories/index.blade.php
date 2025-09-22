@extends('layouts.app')

@section('title', 'Kategorien')

@section('content')
<div class="row mt-5">
    <div class="col">
        <h1>Kategorien</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-4"><i class="bi bi-plus-circle pe-3"></i>Neue Kategorie</a>
        @if ($categories->isEmpty())
            <p>Keine Kategorien vorhanden.</p>
        @else
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $category->name }}
                        <span class="badge bg-secondary rounded-pill">{{ $category->created_at->format('d.m.Y') }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
