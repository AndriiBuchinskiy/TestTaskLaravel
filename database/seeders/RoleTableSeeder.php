<?php

namespace Database\Seeders;


use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'root', 'description' => 'Адміністратор'],
            ['name' => 'admin', 'description' => 'Модератор'],
            ['name' => 'user', 'description' => 'Користувач'],
        ];
        foreach ($roles as $item) {
            $role = new Role();
            $role->name = $item['name'];
            $role->description = $item['description'];
            $role->save();
        }
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'role_id' => 1
        ]);
    }
}
