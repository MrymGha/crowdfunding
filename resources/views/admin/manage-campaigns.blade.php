@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('layouts.sidebar')

    <div class="content">
        <h3>Manage Campaigns</h3>

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
                            <form action="{{ route('admin.delete-campaign', $campaign->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this campaign?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
