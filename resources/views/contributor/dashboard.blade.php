@extends('layouts.app')
@section('content')
<div class="wrapper">
    @include('layouts.sidebar')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h2>Dashboard</h2>
                </div>
                <div class="card-body">
                    <div class="card-stats">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h3>Total Campaigns</h3>
                                <h4>10</h4>
                            </div>
                        </div>
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <h3>Active Campaigns</h3>
                                <h4>5</h4>
                            </div>
                        </div>
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h3>Completed Campaigns</h3>
                                <h4>3</h4>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        
                        <h2>Latest Campaigns</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    {{-- <th>Owner</th> --}}
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestCampaigns as $campaign)
                                    <tr>
                                        <td>{{ $campaign->id }}</td>
                                        <td>{{ $campaign->title }}</td>
                                        {{-- <td>{{ $campaign->owner->name }}</td> --}}
                                        <td>{{ $campaign->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <a href="{{ route('campaigns.show', $campaign) }}" class="btn btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
