@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>Companies list</h1>
    <a class="btn btn-primary" href="{{route('admin.companies.create')}}" role="button">+ Add Company</a>
@stop

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif
    <div class="container mt-5">
        <table id="datatableCompanies" class="table table-bordered mb-5"></table>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#datatableCompanies').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('admin.companies.index') }}",
                columns: [
                    {data: 'name', name: 'name', title: 'Title'},
                    {data: 'address', name: 'address', title: 'Address'},
                    {data: 'clients_count', name: 'clients_count', title: 'Clients', searchable: false},
                    {data: null, name: 'action', title: 'Actions', orderable: false, searchable: false},
                ],
                columnDefs: [ {
                    targets: 3,
                    createdCell: function (td, cellData, rowData, row, col) {
                        console.log(window.location.origin)
                        $(td).html(
                            `<a class="btn btn-primary text-white" href="${window.location.origin}/admin/companies/${rowData.id}" role="button"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-warning text-white" href="${window.location.origin}/admin/companies/${rowData.id}/edit" role="button"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-danger text-white" type="submit" onclick="return deleteRecord(${rowData.id})"><i class="fa fa-trash"></i></button>`
                        )
                    }
                } ]
            });
        });

        function deleteRecord(id)
        {
            if (confirm('Delete this record?')) {
                $.ajax(
                    {
                        url: `${window.location.origin}/admin/companies/${id}`,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: () => { window.location.reload()}
                    }
                )
            }
        }
    </script>
@stop
