<!-- resources/views/campaigns/index.blade.php -->
@extends('layouts.app')

@section('content')
<br>
        <div class="container">
            <h2 class="text-center">Featured Campaigns</h2>
            <br>
            <div class="row">
                <!-- Example campaign card -->
                @foreach ($campaigns as $campaign)
                    <div class="col-md-4">
                        <div class="card campaign-card">
                            @if($campaign->photo)
                                <img src="{{ asset('storage/' . $campaign->photo) }}" class="card-img-top" alt="Campaign Photo">
                            @else
                                <img src="{{ asset('images/hero.svg') }}" class="card-img-top" alt="Default Photo">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $campaign->title }}</h5>
                                <p class="card-text">{{ Str::limit($campaign->description, 100) }}</p>
                                <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-primary">View Campaign</a>
                                @auth
                                    <a href="{{ route('contributions.create', $campaign->id) }}" style="color: white" class="btn btn-warning mt-2">Contribute</a>
                                @else
                                    <a href="{{ route('login') }}" style="color: white"  class="btn btn-warning mt-2">Contribute</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
<style>
    .campaign-listing {
            padding: 50px 0;
        }
        .campaign-card {
            margin-bottom: 30px;
        }
     .card-img-top {
            width: 100%;
            height: 200px; /* Adjust the height as needed */
            object-fit: cover; /* Ensures the image covers the area without stretching */
        }
        .card {
            margin-bottom: 20px; /* Adds some spacing between cards */
        }
        .card-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }
       
</style>
@endsection
