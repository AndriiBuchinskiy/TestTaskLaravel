<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Post::class;
    public function definition(): array
    {
        return [
            'user_id'=> User::get()->random()->id,
            'category_id'=>Category::get()->random()->id,
            'title' =>$this->faker->title,
            'content'=>$this->faker->text(100),
            'created_at' => $this->faker->dateTimeBetween('-200 days', '-50 days'),
            'updated_at' => $this->faker->dateTimeBetween('-40 days', '-1 days'),
        ];
    }
}
