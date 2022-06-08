@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>{{$company->name}}</h1>
@stop

@section('content')

    <div class="container mt-5">
        <div class="card card-dark">
            <div class="card-body">
                <h2>Address: {{$company->address}}</h2>
                <h3>Clients:</h3>
                <ol>
                    @foreach($company->clients as $client)
                        <li>{{$client->full_name}}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

@stop
