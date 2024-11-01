{{-- <h1>Contribute to {{ $campaign->title }}</h1>

<form method="POST" action="{{ route('contributions.store', $campaign) }}">
    @csrf

    <div>
        <label for="amount">Amount</label>
        <input id="amount" type="number" step="0.01" name="amount" required>
        @error('amount')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="paypal_account" >Paypal account</label>
        <input type="email" id="paypal_account" name="paypal_account" required>
        @error('paypal_account')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <button type="submit">Contribute</button>
    </div>
</form> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contribute to {{ $campaign->title }}</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .contribution-form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            background: #ffffff;
        }
        .contribution-form h1 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
            color: #333;
        }
        .contribution-form .form-group {
            margin-bottom: 15px;
        }
        .contribution-form .form-control {
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .contribution-form .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            transition: background-color .15s ease-in-out,border-color .15s ease-in-out;
        }
        .contribution-form .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .contribution-form .invalid-feedback {
            display: block;
            margin-top: .25rem;
            font-size: 80%;
            color: #e3342f;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="contribution-form">
            <h1>Contribute to {{ $campaign->title }}</h1>

            <form method="POST" action="{{ route('contributions.store', $campaign) }}">
                @csrf

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input id="amount" type="number" step="0.01" name="amount" class="form-control @error('amount') is-invalid @enderror" required>
                    @error('amount')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="paypal_account">Paypal account</label>
                    <input type="email" id="paypal_account" name="paypal_account" class="form-control @error('paypal_account') is-invalid @enderror" required>
                    @error('paypal_account')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Contribute</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
