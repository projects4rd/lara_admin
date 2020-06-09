<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'list-users',
            'create-users',
            'edit-users',
            'delete-users',
            'list-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',
            'list-permissions',
            'create-permissions',
            'edit-permissions',
            'delete-permissions',
            'list-posts',
            'create-posts',
            'edit-posts',
            'delete-posts',
            'publish-posts',
            'unpublish-posts'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign created permissions

        $role = Role::create(['name' => 'writer'])
            ->givePermissionTo('edit-posts');

        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['publish-posts', 'unpublish-posts']);
    }
}
