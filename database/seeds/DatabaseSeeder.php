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
        $this->call([RolesAndPermissionsSeeder::class]);
        $this->call([SpacesSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        $this->call([ClientSeeder::class]);
        $this->call([CrimesSeeder::class]);
        $this->call([RecordsSeeder::class]);
        $this->call([OffendersSeeder::class]);
        $this->call([ReservesSeeder::class]);
        $this->call([TasksSeeder::class]);
        
    }
}
