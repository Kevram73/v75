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
        Schema::table('messages', function (Blueprint $table) {
            // Add subject column if it doesn't exist
            if (!Schema::hasColumn('messages', 'subject')) {
                $table->string('subject')->nullable()->after('object');
            }
            
            // Add message column if it doesn't exist
            if (!Schema::hasColumn('messages', 'message')) {
                $table->text('message')->nullable()->after('content');
            }
            
            // Add client_id column if it doesn't exist
            if (!Schema::hasColumn('messages', 'client_id')) {
                $table->unsignedBigInteger('client_id')->nullable()->after('sender_id');
                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            }
            
            // Add response column if it doesn't exist
            if (!Schema::hasColumn('messages', 'response')) {
                $table->text('response')->nullable()->after('message');
            }
            
            // Add response_date column if it doesn't exist
            if (!Schema::hasColumn('messages', 'response_date')) {
                $table->datetime('response_date')->nullable()->after('response');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            if (Schema::hasColumn('messages', 'response_date')) {
                $table->dropColumn('response_date');
            }
            
            if (Schema::hasColumn('messages', 'response')) {
                $table->dropColumn('response');
            }
            
            if (Schema::hasColumn('messages', 'client_id')) {
                $table->dropForeign(['client_id']);
                $table->dropColumn('client_id');
            }
            
            if (Schema::hasColumn('messages', 'message')) {
                $table->dropColumn('message');
            }
            
            if (Schema::hasColumn('messages', 'subject')) {
                $table->dropColumn('subject');
            }
        });
    }
};

