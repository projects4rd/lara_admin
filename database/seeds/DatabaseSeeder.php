<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class); // make sure this goes first
        $this->call(UsersTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
    }
}
