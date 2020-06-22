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
        $this->call(DepartementsTableSeeder::class);
        $this->call(ApplicationTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ApplicationPermissionTableSeeder::class);
        $this->call(MenuPermissionTableSeeder::class);
    }
}
