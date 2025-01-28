@extends('layouts.layout')
@section('content')

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
@endsection
