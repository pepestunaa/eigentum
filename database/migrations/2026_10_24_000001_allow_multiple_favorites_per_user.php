<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The original favorites table made user_id unique, so a user could
     * favorite at most one unit. Allow one row per (user, unit) pair instead.
     */
    public function up(): void
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropUnique('favorites_user_id_unique');
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->unique(['user_id', 'unit_id']);
        });
    }

    public function down(): void
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropUnique('favorites_user_id_unit_id_unique');
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->unique('user_id');
        });
    }
};
