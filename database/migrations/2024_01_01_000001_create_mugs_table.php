<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mugs', function (Blueprint $table) {
            // Primary key for the table
            $table->id();
            
            // Foreign key linking to users table, will delete mugs when user is deleted
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Basic mug details
            $table->string('name');
            $table->text('description');
            
            // Price with 8 digits total, 2 after decimal point (e.g., 999999.99)
            $table->decimal('price', 8, 2);
            
            // Optional image path/URL
            $table->string('image')->nullable();
            
            // Inventory tracking
            $table->integer('stock')->default(0);
            
            // Flag to enable/disable mug listing
            $table->boolean('is_active')->default(true);
            
            // Created_at and updated_at timestamps
            $table->timestamps();
        });
    }

    // Cleanup method to remove the table when rolling back
    public function down(): void
    {
        Schema::dropIfExists('mugs');
    }
};