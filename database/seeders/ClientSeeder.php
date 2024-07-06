<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            //client testing account, do 'php artisan db:seed --class=ClientSeeder'
            'firstname' => 'Super',
            'lastname' => 'Client',
            'mobilenumber' => '0',
            'position' => 'God',
            'email' => 'superclient1@gmail.com',
            'password' => Hash::make('andrei123'),

        ]);
    }
}
