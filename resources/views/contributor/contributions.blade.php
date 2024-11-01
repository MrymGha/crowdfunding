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
                            <h3>My Contributions</h3>
                        </div>
                        <div class="card-body">
                        
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Campaign</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contributions as $contribution)
                                        <tr>
                                            <td>{{ $contribution->campaign->title }}</td>
                                            <td>${{ $contribution->amount }}</td>
                                            <td>{{ $contribution->created_at }}</td>
                                        
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if ($contributions->isEmpty())
                                <p class="text-center">No contribution found.</p>
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
