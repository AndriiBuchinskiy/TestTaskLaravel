<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Position;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $positions = Position::all();
        $position = $this->faker->randomElement($positions);
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'position_id' => $position->id,
            'position' => $position->name,
            'registration_timestamp' => now()->timestamp,
            'photo' => $this->faker->imageUrl(),
            'remember_token' => Str::random(10),
        ];
    }
}
