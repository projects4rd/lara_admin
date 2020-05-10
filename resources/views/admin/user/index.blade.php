@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<table class="table table-bordered" id="users-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
</table>
@endsection

@push('scripts')
<script type="application/javascript">
    $(function () {
        console.log('Before datatable');

        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('get-users) }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
@endpush
