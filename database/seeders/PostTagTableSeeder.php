<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('post_tag')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        if (config('database.default') == 'mysql') {
            $randFunc = 'RAND()';
            $randParam = 0.1;
        } else {
            $randFunc = 'RANDOM()';
            $randParam = 0.1/20;
        }

        DB::statement("
            INSERT INTO post_tag (post_id, tag_id) 
            SELECT p.id, t.id 
            FROM posts p, tags t 
            WHERE $randFunc < $randParam;
        ");
    }
}
