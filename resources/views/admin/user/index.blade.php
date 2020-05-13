@extends('layouts.admin')

@section('title', 'Users')

@section('content')

<div class="row">
    <div class="col-md-5">
        <h3 class="modal-title">{{ $users->count() }} {{ Str::plural('User', $users->count()) }} </h3>
    </div>
    <div class="col-md-7 page-action text-right">
        @can('create-users')
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create</a>
        @endcan
    </div>
</div>

<table class="table table-bordered" id="users-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
        </tr>
    </thead>
</table>
@endsection

@push('scripts')
<script type="application/javascript">
    $(function () {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('users-datatable') !!}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created'},
                {data: 'updated_at', name: 'updated'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
@endpush
