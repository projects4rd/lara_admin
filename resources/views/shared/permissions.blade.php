<div class="card">

    <div class="card-header">
        <h5 class="col-xl-9 offset-xl-3 mb-0">{{ $title ?? 'Override Permissions' }} {!! isset($user) ? '<span
                class="text-danger">(' .
                $user->getDirectPermissions()->count() . ')</span>' : '' !!}
        </h5>
    </div>

    <div class="card-body">
        <div class="form-group row d-flex justify-content-around">
            @foreach($permissions as $permission)

            <?php
                    $permissionFound = null;
                    if ( isset($role) ) {
                        $permissionFound = $role->hasPermissionTo($permission->name);
                    }
                    if ( isset($user)) {
                        $permissionFound = $user->hasDirectPermission($permission->name);
                    }
                ?>

            <div class="col-md-3">
                <label class="ml-3 {{ Str::contains($permission->name, 'delete') ? 'text-danger' : '' }}">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value={{ $permission->name }}
                        id="chk-permission-{{ $permission->id }}" checked={{ $permissionFound }}>
                    {{ $permission->name }}
                </label>
            </div>

            @endforeach
        </div>

    </div>

</div>
