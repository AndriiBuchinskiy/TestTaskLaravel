<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->realText(rand(200, 500)),
            'user_id' => User::get()->random()->id,
            'post_id' => Post::get()->random()->id,
            'created_at' => $this->faker->dateTimeBetween('-200 days', '-50 days'),
            'updated_at' => $this->faker->dateTimeBetween('-40 days', '-1 days'),

        ];
    }
}
