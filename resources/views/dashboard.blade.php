@extends('layouts.layout')
@section('content')

<div class="col-12 text-center">
    <h2>Donation Statistics</h2>
</div>

@foreach($values as $value)
    <x-widget 
        title="{{ $value['title'] }}"
        amount="{{ $value['amount'] }}"
        email="{{ $value['email'] }}"
    />
@endforeach

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary w-25 mt-5 m-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Donate Now
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Fill out the form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="w-50 mt-5 m-auto" action="{{ route('donations.store') }}" method ="POST">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label ">Name</label>
                        <input type="name" class="form-control" id="name" name="donator_name" aria-describedby="name" value="{{ old('name') }}">
                        @error('donator_name')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                        @error('email')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="sum" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                        @error('amount')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Message</label>
                        <input type="text" class="form-control" id="text" name="message">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send a donation</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        let data = google.visualization.arrayToDataTable(@json($chartData));
            
        let options = {
            height: 500,
            width: 1200,
            title: 'Donation Statistics',
            curveType: 'function',
            legend: { position: 'none' }
        };

        const chart = new google.visualization.LineChart(document.getElementById('curve-chart'));

        chart.draw(data, options);
    }
</script>
<div id="curve-chart" style="width: auto; height: auto"></div>
    
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Donator Name<x-sort-direction sort="{{ $sortDirection }}" column="donator_name"/></th>
            <th scope="col">Email<x-sort-direction sort="{{ $sortDirection }}" column="email"/></th>
            <th scope="col">Amount<x-sort-direction sort="{{ $sortDirection }}" column="amount"/></th>
            <th scope="col">Message
            <th scope="col">Date<x-sort-direction sort="{{ $sortDirection }}" column="date"/></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
        <tbody>
        @foreach($donations as $donation)
            <tr>
                <td>
                    {{$donation->donator_name}}
                </td>
                <td>
                    {{$donation->email}}
                </td>
                <td>
                    {{$donation->amount}}
                </td>
                <td>
                    {{$donation->message}}
                </td>
                <td>
                    {{$donation->date}}
                </td>
                <td>
                    <form method="GET" action="{{ route('donations.edit', $donation) }}">
                        <button class="btn btn-outline-success" tittle="Edit">
                            <i class="bi bi-arrow-repeat"></i>
                        </button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('donations.destroy', $donation->id) }}">
                    @csrf
                    @method('delete')
                        <button class="btn btn-outline-danger" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
</table>
<div>            
    {{$donations->links('pagination::bootstrap-5')}}
</div>

@endsection
