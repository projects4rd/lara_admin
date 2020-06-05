<div class="card">

    <div class="card-header">
        <h5 class="col-xl-9 offset-xl-3 mb-0">{{ $title ?? 'Override Permissions' }} {!! isset($user) ? '<span
                class="text-danger"
            >(' .
                $user->getDirectPermissions()->count() . ')</span>' : '' !!}
        </h5>
    </div>

    <div class="card-body">
        <div class="form-group row d-flex justify-content-around">
            <?php $permissionGroup = ''; ?>
            @foreach($permissions as $permission)

            <?php
                    $permissionFound = null;
                    if ( isset($role) ) {
                        $permissionFound = $role->hasPermissionTo($permission->name);
                    }
                    if ( isset($user)) {
                        $permissionFound = $user->hasDirectPermission($permission->name);
                    }

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
                    <label class="{{ Str::contains($permission->name, 'delete') ? 'text-danger' : '' }}">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="permissions[]"
                            value="{{ $permission->name }}"
                            id="chk-permission-{{ $permission->id }}"
                            {{ $permissionFound ? 'checked="checked"' : "" }}
                        >
                        {{ $permission->name }}
                    </label>
                </li>

                @endforeach
        </div>

    </div>
</div>