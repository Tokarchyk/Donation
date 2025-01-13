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
<body>
<div class="row">

<div class="col-12 text-center">
    <h2>Donation Statistics</h2>
</div>

<div class="col-sm-6 col-md-4">
    <div class="bg-color-card">
        <div class="card-header">Top Donator</div>
        <div class="card-body">
            <h3>{{ $topDonation->amount }}</h3>
            <h6>{{ $topDonation->email }}</h6>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-4">
    <div class="bg-color-card">
        <div class="card-header">Last Month Amount</div>
        <div class="card-body">
          <h3>{{ $totalSum }}</h3>
        </div>
      </div>
</div>

<div class="col-sm-6 col-md-4">
    <div class="bg-color-card">
      <div class="card-header">All Time Amount</div>
      <div class="card-body">
        <h3>{{ $totalAmountDonation }}</h3>
      </div>
    </div>
  </div>
</div>

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
