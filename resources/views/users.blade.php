@extends('layouts.layout')
@section('content')

<div class="col-12 text-center">
    <h2>Users Table</h2>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">ID<x-sort-direction sort="" column="donator_name"/></th>
            <th scope="col">Name<x-sort-direction sort="" column="email"/></th>
            <th scope="col">Email<x-sort-direction sort="" column="amount"/></th>
            <th scope="col"></th>
        </tr>
    </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    {{$user->id}}
                </td>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    <form method="GET" action="{{ route('users.show', $user) }}">
                        <button class="btn btn-outline-success" tittle="Info">
                            <i class="bi bi-info-circle"></i>
                        </button>
                    </form>
                </td>
                @endforeach
        </tbody>
</table>
@endsection
