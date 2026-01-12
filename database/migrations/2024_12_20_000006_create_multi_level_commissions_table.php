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
        Schema::create('multi_level_commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('referrer_id');
            $table->integer('level');
            $table->decimal('amount', 15, 2);
            $table->decimal('percentage', 5, 2);
            $table->enum('status', ['PENDING', 'COMPLETED', 'CANCELLED'])->default('PENDING');
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('referrer_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('set null');
            $table->index(['client_id', 'referrer_id', 'level']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multi_level_commissions');
    }
};

