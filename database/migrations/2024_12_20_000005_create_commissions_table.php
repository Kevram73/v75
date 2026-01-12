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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('referrer_id');
            $table->decimal('amount', 15, 2);
            $table->decimal('percentage', 5, 2);
            $table->enum('type', ['REFERRAL', 'TEAM_REWARD', 'BONUS'])->default('REFERRAL');
            $table->enum('status', ['PENDING', 'COMPLETED', 'CANCELLED'])->default('PENDING');
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('referrer_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('set null');
            $table->index(['client_id', 'referrer_id']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};

