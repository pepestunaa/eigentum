<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Corrects column types that were too small or semantically wrong, and
     * adds indexes/constraints on the foreign keys used by every search and
     * detail page.
     */
    public function up(): void
    {
        // Indonesian property prices reach hundreds of billions of rupiah;
        // decimal(7,2) capped at 99,999.99
        Schema::table('units', function (Blueprint $table) {
            $table->decimal('price', 15, 2)->change();
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->foreign('developer_id')->references('id')->on('developers');
            $table->index('developer_id');
        });

        Schema::table('units', function (Blueprint $table) {
            $table->foreign('property_id')->references('id')->on('properties');
            $table->index('property_id');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subscribe_id')->references('id')->on('subscribes');
            $table->index(['user_id', 'payment_status']);
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('unit_id')->references('id')->on('units');
        });

        Schema::table('property_agent', function (Blueprint $table) {
            $table->index(['property_id', 'agent_id']);
        });
    }

    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
            $table->dropIndex(['property_id']);
            $table->decimal('price', 7, 2)->change();
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['developer_id']);
            $table->dropIndex(['developer_id']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['subscribe_id']);
            $table->dropIndex(['user_id', 'payment_status']);
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['unit_id']);
        });

        Schema::table('property_agent', function (Blueprint $table) {
            $table->dropIndex(['property_id', 'agent_id']);
        });
    }
};
