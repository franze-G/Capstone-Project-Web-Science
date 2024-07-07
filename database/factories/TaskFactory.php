<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Task::class;
    
    public function definition()
    {
        return [
            //
            'title' => fake()->sentence(),
            'description' => fake()->realText(),
            'due_date' => fake()->dateTimeBetween('now','+1 year'),
            'rate' => fake()->realText(),
            'status' => fake()->randomElement(['pending','in_progress','completed']),
            'priority' => fake()->randomElement(['low','high']),
            'image_path' => fake()->imageURL(),
            'assigned_user_id' => 1,
            'created_at' => 1,
            'updated_at' => 1
        ];
    }
}
