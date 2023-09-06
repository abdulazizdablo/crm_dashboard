<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\StatusModel;

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
    public function definition(): array
    {
        return [
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'project_id' => 1,
            'client_id' => 1,
            'user_id' => 1,
            'deadline' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(StatusModel::values())

        ];
    }
}
