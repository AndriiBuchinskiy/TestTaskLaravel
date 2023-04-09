<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $permissions =  [
            ['name' => 'role.create', 'description' => 'create new role'],
            ['name' => 'role.access', 'description' => 'access role'],
            ['name' => 'role.update', 'description' => 'update role'],
            ['name' => 'role.delete', 'description' => 'delete role'],
            ['name' => 'user.create', 'description' => 'create new user'],
            ['name' => 'user.access', 'description' => 'access user'],
            ['name' => 'user.update', 'description' => 'update user'],
            ['name' => 'user.delete', 'description' => 'delete user'],
            ['name' => 'post.create', 'description' => 'create new post'],
            ['name' => 'post.access', 'description' => 'access post'],
            ['name' => 'post.update', 'description' => 'update post'],
            ['name' => 'post.delete', 'description' => 'delete post'],
            ['name' => 'tag.create', 'description' => 'create new tag'],
            ['name' => 'tag.access', 'description' => 'access tag'],
            ['name' => 'tag.update', 'description' => 'update tag'],
            ['name' => 'tag.delete', 'description' => 'delete tag'],
            ['name' => 'categories.create', 'description' => 'create new categories'],
            ['name' => 'categories.access', 'description' => 'access categories'],
            ['name' => 'categories.update', 'description' => 'update categories'],
            ['name' => 'categories.delete', 'description' => 'delete categories'],
            ['name' => 'comment.create', 'description' => 'create new comment'],
            ['name' => 'comment.access', 'description' => 'access comment'],
            ['name' => 'comment.update', 'description' => 'update comment'],
            ['name' => 'comment.delete', 'description' => 'delete comment'],
        ];
        foreach ($permissions as $item) {
            $permission = new Permission();
            $permission->name = $item['name'];
            $permission->description = $item['description'];
            $permission->save();
        }
    }
}
