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
        Schema::table('investments', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign(['plan_id']);
            
            // Make plan_id nullable
            $table->unsignedBigInteger('plan_id')->nullable()->change();
            
            // Re-add the foreign key with nullable support
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            // Drop the foreign key
            $table->dropForeign(['plan_id']);
            
            // Make plan_id not nullable again
            $table->unsignedBigInteger('plan_id')->nullable(false)->change();
            
            // Re-add the foreign key
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });
    }
};

