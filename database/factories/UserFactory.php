<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'avatar' => $this->faker->imageUrl(200, 200, 'people'),
        ];
    }
}
