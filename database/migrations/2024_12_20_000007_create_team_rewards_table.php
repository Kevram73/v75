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
        Schema::create('team_rewards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->integer('level');
            $table->string('title');
            $table->integer('required_directs');
            $table->decimal('required_turnover', 15, 2);
            $table->decimal('monthly_salary', 15, 2);
            $table->integer('current_directs')->default(0);
            $table->decimal('current_turnover', 15, 2)->default(0.00);
            $table->enum('status', ['PENDING', 'ACHIEVED', 'MAINTAINED'])->default('PENDING');
            $table->date('achieved_at')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->index(['client_id', 'level']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_rewards');
    }
};

