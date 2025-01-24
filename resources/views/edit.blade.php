<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
</head>
<link rel="stylesheet" href="css/app.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
<body>

<form class="w-50 mt-5 m-auto" action="{{ route('donations.update', $donation) }}" method ="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
                <label for="name" class="form-label ">Name</label>
                <input type="name" class="form-control" id="name" 
                        name="donator_name" aria-describedby="name" 
                        value="{{ $donation->donator_name }}">
                @error('donator_name')
                        <div class="error-message">{{ $message }}</div>
                @enderror
        </div>
        <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" 
                        name="email" aria-describedby="emailHelp"
                        value="{{ $donation->email }}">
                @error('email')
                        <div class="error-message">{{ $message }}</div>
                @enderror
        </div>
        <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="sum" class="form-control" id="amount" 
                        name="amount" 
                        value="{{ $donation->amount }}">
                @error('amount')
                        <div class="error-message">{{ $message }}</div>
                @enderror
        </div>
        <div class="mb-3">
                <label for="text" class="form-label">Message</label>
                <input type="text" class="form-control" id="text" 
                        name="message" 
                        value="{{ $donation->message }}">
        </div>
        <button type="submit" class="btn btn-primary">Save update</button>
</form>
</body>
</html>
