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
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('referrer_id')->nullable()->after('father_fellow');
            $table->boolean('is_commissioned')->default(true)->after('referrer_id');
            $table->boolean('is_active_referral')->default(true)->after('is_commissioned');
            
            $table->foreign('referrer_id')->references('id')->on('clients')->onDelete('set null');
            $table->index(['referrer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['referrer_id']);
            $table->dropIndex(['referrer_id']);
            $table->dropColumn(['referrer_id', 'is_commissioned', 'is_active_referral']);
        });
    }
};

