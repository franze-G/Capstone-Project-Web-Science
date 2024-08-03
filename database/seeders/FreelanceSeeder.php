<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\FreelanceFactory;

class FreelanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //gets the freelancer factory change mo count kung gano karami gusto mo
        //php artisan db:seed --class=FreelanceSeeder
        \App\Models\User::factory(FreelanceFactory::class)->count(15)->create();
    }
}
