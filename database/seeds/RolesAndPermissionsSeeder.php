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
			'list-role',
			'create-role',
			'edit-role',
			'delete-role',
			'edit-post',
			'delete-post',
			'publish-post',
			'unpublish-post'
		];
		
		foreach ($permissions as $permission){		
			Permission::create(['name' => $permission]);
		}

        // create roles and assign created permissions

        $role = Role::create(['name' => 'writer'])
			->givePermissionTo('edit-post');

        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['publish-post', 'unpublish-post']);

    }
}
