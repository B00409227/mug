<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add a role column to users table.
     * This migration replaces any existing 'role' column with a new one.
     */
    public function up(): void
    {
        // First, check if 'role' column exists and drop it if it does
        // This prevents duplicate column errors
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });

        // Add new 'role' column with default value 'user'
        // The column is non-nullable to ensure every user has a role
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     * Replaces the 'role' column with boolean flags for admin and merchant status
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add boolean columns for different user types
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_merchant')->default(false);
            // Remove the role column
            $table->dropColumn('role');
        });
    }
};
