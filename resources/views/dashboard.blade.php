<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<body>
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
    <th scope="row">
      {{$donation->donator_name}}
    </th>
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
