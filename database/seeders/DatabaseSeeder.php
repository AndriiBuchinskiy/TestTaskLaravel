<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Events\UpdateUserAmount;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            UserProductSeeder::class,
        ]);

        $users = User::all();
        foreach ($users as $user) {
            event(new UpdateUserAmount($user));
        }

    }
}
