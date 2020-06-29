<?php

use Illuminate\Database\Seeder;

class SpacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Space::class, 50)->create();

    }
}
