@extends('layouts.app')

@section('title', 'Create')

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Create</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('users.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8">
                @csrf
                
                @include('user.form')

                <!-- Submit Form Button -->
                <input type="submit" value="Create" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection