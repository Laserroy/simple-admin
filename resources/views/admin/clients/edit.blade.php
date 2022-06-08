@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>Edit client</h1>
@stop

@section('content')
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{route('admin.clients.update', compact('client'))}}">
            @csrf
            @method('PUT')
            <div class="form-group mb-3 row">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{$client->first_name}}">
            </div>
            <div class="form-group mb-3 row">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{$client->last_name}}">
            </div>
            <div class="form-group mb-3 row">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone"  value="{{$client->phone}}">
            </div>
            <div class="form-group mb-3 row">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email"  value="{{$client->email}}">
            </div>
            <div class="form-group mb-3 row">
                <label for="companySelect" class="col-12">Select companies for client</label>
                <select id="companySelect" class="form-control col-12" name="clients[]" multiple="multiple">
                    @foreach($client->companies as $company)
                        <option value="{{$company->id}}" selected="selected">{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 row">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>

@stop


@section('js')
    <script>
        $(document).ready(function() {
            $('#companySelect').select2({
                ajax: {
                    url: '{{route('admin.typeahead.companies')}}',
                    dataType: 'json',
                    data: function (params) {
                        let query = {
                            search: params.term,
                            page: params.page || 1
                        };

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                },
            });
        });
    </script>
@stop
