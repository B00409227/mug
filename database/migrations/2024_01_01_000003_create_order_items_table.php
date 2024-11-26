<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            // Primary key for the table
            $table->id();
            
            // Foreign keys linking to orders and mugs tables
            // Both will cascade delete if parent record is removed
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('mug_id')->constrained()->onDelete('cascade');
            
            // Number of mugs ordered
            $table->integer('quantity');
            
            // Price at time of order (8 digits total, 2 after decimal)
            // Stored separately from mug price in case mug price changes later
            $table->decimal('price', 8, 2);
            
            // Created_at and updated_at timestamps
            $table->timestamps();
        });
    }

    // Cleanup method to remove the table when rolling back
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};