<?php

namespace Database\Factories;

use App\Models\UserProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;


class UserProductFactory extends Factory
{
    protected $model = UserProduct::class;

    //protected $user = User::inRandomOrder()->first();

    public function definition(): array
    {
        return [
            'user_id' => User::get()->random()->id,
            'product_id' => Product::get()->random()->id,
        ];
    }
}
