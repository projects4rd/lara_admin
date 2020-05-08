@extends('layouts.admin')

@section('title', 'Users')

@section('content')
{{-- <div class="row">
    <div class="col-md-5">
        <h3 class="modal-title">{{ $users->total() }} {{ Str::plural('User', $users->count()) }} </h3>
    </div>
    <div class="col-md-7 page-action text-right">
        @can('create-users')
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create</a>
        @endcan
    </div>
</div> --}}

{{-- <div class="users-set">
    <table class="table table-bordered table-striped table-hover" id="data-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                @can('edit-users', 'delete-users')
                <th class="text-center">Actions</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach($users as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->roles->implode('name', ', ') }}</td>
                <td>{{ $item->created_at->toFormattedDateString() }}</td>

                @can('edit-users')
                <td class="text-center">
                    @include('shared.actions', [
                    'entity' => 'users',
                    'id' => $item->id
                    ])
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {{ $users->links() }}
    </div>
</div> --}}

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success mb-2" id="new-user" data-toggle="modal">New User</a>
            </div>
        </div>
    </div>
        
    <table class="table table-bordered data-table" >
    <thead>
        <tr id="">
            <th width="5%">No</th>
            <th width="5%">Id</th>
            <th width="30%">Name</th>
            <th width="30%">Email</th>
            <th width="20%">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    </table>

    <script type="text/javascript">

        $(document).ready(function () {
        
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection
