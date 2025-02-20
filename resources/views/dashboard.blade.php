@extends('layouts.layout')
@section('content')
@vite(['resources/js/app.js'])

<div class="col-12 text-center">
    <h2>Donation Statistics</h2>
</div>

<!-- ADD WIDGET COMPONENT -->

<div id="app" >
    <!-- <card-component></card-component> -->
    <widget-component></widget-component>


@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary w-25 mt-4 d-grid gap-2 col-6 mx-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
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

<!-- Google graphics -->
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
<table-component></table-component>
</div>

@endsection
