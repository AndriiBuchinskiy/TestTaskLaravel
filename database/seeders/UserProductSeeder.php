<?php

namespace Database\Seeders;


use App\Models\UserProduct;
use Illuminate\Database\Seeder;

class UserProductSeeder extends Seeder
{
    public function run(): void
    {
        UserProduct::factory()->count(10)->create();
    }
}
