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
        Schema::create('retrieve_requests', function (Blueprint $table) {
            $table->id();
            $table->decimal('price_amount', 16, 8);
            $table->string('price_currency');
            $table->foreignId('user_id');
            $table->string('to_account');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retrieve_requests');
    }
};
