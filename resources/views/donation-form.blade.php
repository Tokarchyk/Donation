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
<form class="w-50 mt-5 m-auto" action="{{ route('donation.store') }}" method ="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label ">Name</label>
        <input type="name" class="form-control" id="name" name="donator_name" aria-describedby="name">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="amount" class="form-label">Amount</label>
        <input type="sum" class="form-control" id="amount" name="amount">
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Message</label>
        <input type="text" class="form-control" id="text" name="message">
    </div>
    <button type="submit" class="btn btn-primary">Send a donation</button>
</form>
</body>
</html>
