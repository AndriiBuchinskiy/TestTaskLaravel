<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Position;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $positions = Position::all();
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'position' => $this->faker->randomElement($positions)->name,
            'position_id' => function () use ($positions) {
                return $this->faker->randomElement($positions)->id;
            },
            'registration_timestamp' => now()->timestamp,
            'photo' => $this->faker->imageUrl(),
        ];
    }
}
