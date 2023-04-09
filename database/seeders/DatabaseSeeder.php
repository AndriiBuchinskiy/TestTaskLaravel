<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use Database\Factories\RoleFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleTableSeeder::class,
            UserTableSeeder::class,
            CategoryTableSeeder::class,
            PostTableSeeder::class,
            TagTableSeeder::class,
            CommentTableSeeder::class,
            PermissionsTableSeeder::class,
            PostTagTableSeeder::class



        ]);

    }
}
