@extends('layout')

@section('content')

@foreach ($listings as $listing)
    <h1>
    <a href="/listing/{{ $listing->id }}">
        {{ $listing->title }}
    </a>
    </h1>
    <p>{{ $listing->description }}</p>
@endforeach

@endsection
