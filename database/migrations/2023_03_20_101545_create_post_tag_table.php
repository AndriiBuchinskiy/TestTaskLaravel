<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_tag', function (Blueprint $table) {
               $table->id();
               $table->unsignedBigInteger('post_id');
               $table->unsignedBigInteger('tag_id');
               $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            // Додано зовнішній ключ на колонку 'tag_id' таблиці 'tags' з обмеженням 'restrict'
               $table->foreign('tag_id')->references('id')->on('tags')->onDelete('restrict')->onUpdate('cascade');

               $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};
