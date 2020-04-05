@extends('layouts.admin')

@section('title', 'Roles & Permissions')

@section('content')

<!-- Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
    <div class="modal-dialog" role="document">

        <form method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="roleModalLabel">Role</h4>
                </div>
                <div class="modal-body">
                    <!-- name Form Input -->
                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="Name" class="form-control" placeholder='Name'>

                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <!-- Submit Form Button -->
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
        </form>
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-5">
        <h3>Roles</h3>
    </div>
    <div class="col-md-7 page-action text-right">
        @can('create-roles')
        <a href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#roleModal"> <i
                class="glyphicon glyphicon-plus"></i> New</a>
        @endcan
    </div>
</div>


@forelse ($roles as $role)
<form method="POST" action="{{ route('roles.update',  $role->id) }}" class="m-b">
    @csrf
    @method('PUT')

    @if($role->name === 'Admin')
    @include('shared.permissions', [
    'title' => $role->name .' Permissions',
    'options' => ['disabled']
    ]
    )
    @else
    @include('shared.permissions', [
    'title' => $role->name .' Permissions',
    'model' => $role ])
    @can('edit-roles')
    <input type="submit" value="Save" class="btn btn-primary">
    @endcan
    @endif

</form>

@empty
<p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
@endforelse
@endsection
