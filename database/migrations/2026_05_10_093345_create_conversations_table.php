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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            
            // Participants
            $table->foreignId('seller_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('buyer_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            
            // Product reference (optional)
            $table->foreignId('product_id')
                  ->nullable()
                  ->constrained('products')
                  ->cascadeOnDelete();
            
            // Metadata
            $table->text('subject')->nullable();
            $table->timestamp('last_message_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('seller_id');
            $table->index('buyer_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
