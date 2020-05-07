@extends('layouts.admin')

@section('title', 'Permissions')

@section('content')

<div class="card-body">
    <div class="form-group row d-flex justify-content-around">
        <?php $permissionGroup = ''; ?>
        @foreach($permissions as $permission)

            <?php
                $newGroup = false;
                if ($permissionGroup !== $permission->group){
                    $newGroup = true;
                    $permissionGroup = $permission->group;
                } 
            ?>

            @if ($newGroup)
                @if ($permissionGroup !== '') </ul> @endif
                <ul>
                   <h6 class="d-flex justify-content-start">{{$permission->group}}</h6>
            @endif

            <li>                
                {{--  <label class="{{ Str::contains($permission->name, 'delete') ? 'text-danger' : '' }}">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value={{ $permission->name }}
                        id="chk-permission-{{ $permission->id }}">
                    {{ $permission->name }} - {{ $permission->guard_name }}
                </label>  --}}
                <a href="#" 
                    id="permission-{{ $permission->id }}"
                    class="{{ Str::contains($permission->name, 'delete') ? 'text-danger' : '' }}">
                    {{ $permission->name }}
                </a>
            </li>

        @endforeach
    </div>

</div>  

@endsection
