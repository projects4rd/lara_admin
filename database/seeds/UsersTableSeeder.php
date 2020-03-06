<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $admin = [
            'name' => "Administrator",
            'slug' => 'admin',
            'email' => "admin@test.com",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];

        // DB::table('users')->insert($admin);
        $adminUser = User::create($admin);
        $role = Role::create(['name' => 'super-admin']);
        $adminUser->assignRole([$role->id]);
        
        factory(User::class, 10)->create();
    }
}
