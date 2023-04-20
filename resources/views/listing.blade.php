@extends('layout')

@section('content')

    <h1>
    <a href="/listings/{{ $listing->id }}">
        {{ $listing->title }}
    </a>
    </h1>
    <p>{{ $listing->description }}</p>

@endsection
