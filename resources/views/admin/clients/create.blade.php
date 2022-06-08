@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>Add new client</h1>
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
        <form method="POST" action="{{route('admin.clients.store')}}">
            @csrf
            <div class="form-group mb-3 row">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{old('first_name')}}">
            </div>
            <div class="form-group mb-3 row">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name')}}">
            </div>
            <div class="form-group mb-3 row">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone"  value="{{old('phone')}}">
            </div>
            <div class="form-group mb-3 row">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email"  value="{{old('email')}}">
            </div>
            <div class="form-group mb-3 row">
                <label for="companySelect" class="col-12">Select companies for client</label>
                <select id="companySelect" class="form-control col-12" name="companies[]" multiple="multiple">
                </select>
            </div>
            <div class="mb-3 row">
                <button type="submit" class="btn btn-primary">Create</button>
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
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
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
