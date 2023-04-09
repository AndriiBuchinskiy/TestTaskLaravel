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
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');

            $table->index('role_id', 'role_permission_role_idx');
            $table->index('permission_id', 'role_permission_permission_idx');

            $table->foreign('role_id', 'role_permission_role_fk')->on('roles')->references('id');
            $table->foreign('permission_id', 'role_permission_permission_fk')->on('permissions')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_role');
    }
};
