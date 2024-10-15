<?php

namespace Database\Factories;

use App\Models\Profiles;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfilesFactory extends Factory
{
    protected $model = Profiles::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name, // Genera un nombre aleatorio
            'image' => $this->faker->imageUrl(200, 200, 'people'), // Genera una URL de imagen aleatoria
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
