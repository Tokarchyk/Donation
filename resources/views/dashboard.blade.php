@extends('layouts.layout')
@section('content')
@vite(['resources/js/app.js'])

<div class="col-12 text-center">
    <h2>Donation Statistics</h2>
</div>

<!-- ADD WIDGET COMPONENT -->

<div id="app" >
    <widget-component></widget-component>

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

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
