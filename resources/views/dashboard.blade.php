<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<body>
<div class="row">

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
            <th scope="col">Donator Name</th>
            <th scope="col">Email</th>
            <th scope="col">Amount</th>
            <th scope="col">Message</th>
            <th scope="col">Date</th>
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
            </tr>
        @endforeach
</table>
<div>            
    {{$donations->links('pagination::bootstrap-5')}}
</div>
</body>
</html>
