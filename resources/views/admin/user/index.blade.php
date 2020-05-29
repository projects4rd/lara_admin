@extends('layouts.admin')

@section('title', 'Users')

@section('content')

<section class="rd-subheader">

    <div class="rd-subheader__main">
        <h5 class="rd-subheader__title">
            Users
        </h5>

        <span class="rd-subheader__separator rd-subheader__separator--v"></span>

        <span class="rd-subheader__desc text-left">
            Display All Users 
        </span>

    </div>

    <div class="rd-subheader__toolbar text-right">
        <nav class="text-right" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Users</li>
            </ol>
        </nav>
    </div>

</section>

<div class="row my-3">
    <div class="col-md-7 page-action text-left">
        @can('create-users')
        <a href="{{ route('users.create') }}" class="btn btn-success btn-sm"> <i class="fas fa-user-plus"></i> Add New</a>
        @endcan
    </div>
    <div class="col-md-5 text-right">
        <h5 class="modal-title">{{ $users->count() }} {{ Str::plural('User', $users->count()) }} </h5>
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

@push('page-script')
<script type="application/javascript">
    $(function () {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
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
