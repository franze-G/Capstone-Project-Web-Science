<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //uncomment mo nalang if ever
        // User::factory(10)->withPersonalTeam()->create();s
        // User::factory()->withPersonalTeam()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('123.321'),
        //     'email_verified_at' => time()
        // ]);

        // Project::factory()
        //     ->count(30)
        //     ->hasTask(30)
        //     ->create();

        // $this->call(TaskSeeder::class);

        //freelance seeder
        $this->call(FreelanceSeeder::class);
    }
}
