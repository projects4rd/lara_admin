<div class="card my-3">
    <div class="card-header" role="tab" id="{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
        <h4 class="mb-0">
            <a role="button" data-toggle="collapse" href="#dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}" aria-expanded="{{ isset($closed) ? 'true' : 'false' }}" aria-controls="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
                {{ $title ?? 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </a>
        </h4>
    </div>
    <div id="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}" class="card-collapse collapse {{ $closed ?? 'in' }}" role="tabcard" aria-labelledby="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
        <div class="card-body">
            <div class="row">
                @foreach($permissions as $perm)
                    <?php
                        $permFound = null;
                        if( isset($role) ) {
                            $permFound = $role->hasPermissionTo($perm->name);
                        }
                        if( isset($user)) {
                            $permFound = $user->hasDirectPermission($perm->name);
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="checkbox">
                            <label class="{{ Str::contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                {!! Form::checkbox("permissions[]", $perm->name, $permFound, isset($options) ? $options : []) !!} {{ $perm->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
