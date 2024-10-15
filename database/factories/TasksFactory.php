<?php

namespace Database\Factories;

use App\Models\Tasks;
use App\Models\Profiles;
use Illuminate\Database\Eloquent\Factories\Factory;

class TasksFactory extends Factory
{
    protected $model = Tasks::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'profileid' => Profiles::factory()->create()->id, // Crea un perfil y usa su ID
        ];
    }
}
