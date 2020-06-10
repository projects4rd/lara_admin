@extends('layouts.admin')

@section('title', 'Edit User ' . $user->name)

@section('content')

<div class="row">
    <div class="col-md-5">
        <h3>Edit {{ $user->name }}</h3>
    </div>
    <div class="col-md-7 page-action text-right">
        <a href="{{ route('users.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form method="POST" action="{{ route('users.update',  $user->id) }}" accept-charset="UTF-8">
                        @csrf
                        @method('PUT')

                        @include('admin.user.edit-form')

                        <!-- Submit Form Button -->
                        <input type="submit" value="Save Changes" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
