<h1>Contribute to {{ $campaign->title }}</h1>

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
        <button type="submit">Contribute</button>
    </div>
</form>
