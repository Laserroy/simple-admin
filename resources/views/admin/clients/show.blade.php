@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>{{$client->full_name}}</h1>
@stop

@section('content')

    <div class="container mt-5">
        <div class="card card-dark">
            <div class="card-body">
                <p>Email: {{$client->email}}</p>
                <p>Phone: {{$client->phone}}</p>
                <p>Companies:</p>
                <ol>
                    @foreach($client->companies as $company)
                        <li>{{$company->name}}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

@stop
