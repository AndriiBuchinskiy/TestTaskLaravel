<?php

namespace Database\Factories;


use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tag::class;
    public function definition(): array
    {
        return [
            'name'=>$this->faker->word,
            'created_at' => $this->faker->dateTimeBetween('-200 days', '-50 days'),
            'updated_at' => $this->faker->dateTimeBetween('-40 days', '-1 days'),
        ];
    }
}
