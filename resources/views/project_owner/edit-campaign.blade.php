@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('layouts.sidebar')

    <div class="content">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>Edit Campaign</h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('project_owner.update-campaign', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $campaign->title }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ $campaign->description }}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="goal_amount">Goal Amount</label>
                                    <input type="number" class="form-control" id="goal_amount" name="goal_amount" value="{{ $campaign->goal_amount }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="photo">Campaign Photo</label>
                                    <input type="file" class="form-control-file" id="photo" name="photo">
                                    @if($campaign->photo)
                                        <img src="{{ asset('storage/' . $campaign->photo) }}" alt="Campaign Photo" class="img-thumbnail mt-2" style="width: 200px;">
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="paypal_account">PayPal Account</label>
                                    <input type="email" class="form-control" id="paypal_account" name="paypal_account" value="{{ $campaign->decrypted_paypal_account }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mt-4">Update Campaign</button>
                            </form>
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
</style>
@endsection
