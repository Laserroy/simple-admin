@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>Create new company</h1>
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
        <form method="POST" action="{{route('admin.companies.store')}}">
            @csrf
            <div class="form-group mb-3 row">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
            </div>
            <div class="form-group mb-3 row">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address"  value="{{old('address')}}">
            </div>
            <div class="form-group mb-3 row">

                    <label for="clientSelect" class="col-12">Select clients for company</label>
                    <select id="clientSelect" class="form-control col-12" name="clients[]" multiple="multiple">
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
            $('#clientSelect').select2({
                ajax: {
                    url: '{{route('admin.typeahead.clients')}}',
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
                                    text: `${item.first_name} ${item.last_name}`,
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
