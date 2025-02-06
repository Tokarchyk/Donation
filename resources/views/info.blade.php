@extends('layouts.layout')
@section('content')

<div class="position-relative">
<h2 class:"">Donations user: {{ $user->name }}</h2>
</div>
<div>
    <form class="d-flex" action="{{ route('impersonate.start', $user->id) }}" method="GET">
        <button type="submit" class="btn btn-outline-info">Login as...{{ $user->name }}</button>
    </form>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">email</th>
            <th scope="col">Message</th>
            <th scope="col">Amount</th>
            <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user->donations as $donation)
            <tr>
                <td>{{ $donation->email }}$</td>
                <td>{{ $donation->message }}</td>
                <td>{{ $donation->amount }}</td>
                <td>{{ $donation->created_at->format('d.m.Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<h3 class="">All donations: {{ $userAmountDonations->donations_sum_amount }}</h3>
@endsection
