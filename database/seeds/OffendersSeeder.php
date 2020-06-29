<?php

use Illuminate\Database\Seeder;

class OffendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Offender::class, 50)->create();

    }
}
