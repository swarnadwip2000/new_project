<?php

namespace Database\Seeders;

use Database\Factories\TollFactory;
use Illuminate\Database\Seeder;

class TollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Toll::factory(10)->create();
    }
}
