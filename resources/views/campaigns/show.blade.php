@extends('layouts.app')

@section('title', $campaign->title)

@section('content')
<div class="container mt-5">
    <div class="card mb-4 shadow-sm">
        @if($campaign->photo)
        <img src="{{ asset('storage/' . $campaign->photo) }}" class="card-img-top" alt="{{ $campaign->title }}">
        @else
        <img src="{{ asset('images/hero.svg') }}" class="card-img-top" alt="Default Campaign Image">
        @endif
        <div class="card-body">
            <h1 class="card-title">{{ $campaign->title }}</h1>
            <p class="card-text">{{ $campaign->description }}</p>
            <div class="d-flex justify-content-between">
                <p class="card-text"><strong>Goal:</strong> ${{ number_format($campaign->goal_amount, 2) }}</p>
                <p class="card-text"><strong>Current:</strong> ${{ number_format($campaign->current_amount, 2) }}</p>
            </div>
            @auth
                <a href="{{ route('contributions.create', $campaign->id) }}" class="btn btn-warning mt-2 text-white">Contribute</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-warning mt-2 text-white">Contribute</a>
            @endauth
        </div>
    </div>
</div>
@endsection
