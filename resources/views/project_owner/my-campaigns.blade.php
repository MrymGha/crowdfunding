@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('layouts.sidebar')

    <div class="content">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3>Manage Campaigns</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <a href="{{route('project_owner.create-campaign')}}" class="btn btn-success">Create a New Campaign</a>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Goal Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($campaigns as $campaign)
                                        <tr>
                                            <td>{{ $campaign->title }}</td>
                                            <td>{{ $campaign->description }}</td>
                                            <td>${{ $campaign->goal_amount }}</td>
                                            <td>
                                                <a href="{{ route('project_owner.edit-campaign', $campaign->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('project_owner.delete-campaign', $campaign->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this campaign?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if ($campaigns->isEmpty())
                                <p class="text-center">No campaigns found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .wrapper {
        display: flex;
        min-height: 100vh;
    }

    .content {
        flex: 1;
        padding: 20px;
        background-color: #f8f9fa;
    }

    .card-header {
        background-color: #007bff;
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
</style>
@endsection
