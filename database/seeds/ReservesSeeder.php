<?php

use Illuminate\Database\Seeder;

class ReservesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Reserve::class, 50)->create();

    }
}
