@extends('adminlte::page')

@section('title', 'Clients')

@section('content_header')
    <h1>Clients list</h1>
    <a class="btn btn-primary" href="{{route('admin.clients.create')}}" role="button">+ Add Client</a>
@stop

@section('content')
    <div class="container mt-5">
        <table id="datatable" class="table table-bordered mb-5"></table>
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('admin.clients.index') }}",
                columns: [
                    {data: 'first_name', name: 'first_name', title: 'First Name'},
                    {data: 'last_name', name: 'last_name', title: 'Last Name'},
                    {data: 'email', name: 'email', title: 'Email'},
                    {data: 'phone', name: 'phone', title: 'Phone'},
                    {data: 'companies_count', name: 'companies_count', title: 'Companies', searchable: false},
                    {data: null, name: 'action', title: 'Actions', orderable: false, searchable: false},
                ],
                columnDefs: [ {
                    targets: 5,
                    createdCell: function (td, cellData, rowData, row, col) {
                        console.log(window.location.origin)
                        $(td).html(
                            `<a class="btn btn-primary text-white" href="${window.location.origin}/admin/clients/${rowData.id}" role="button"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-warning text-white" href="${window.location.origin}/admin/clients/${rowData.id}/edit" role="button"><i class="fa fa-edit"></i></a>
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
                        url: `${window.location.origin}/admin/clients/${id}`,
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
