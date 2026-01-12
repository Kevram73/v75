<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add client_id if it doesn't exist
        if (!Schema::hasColumn('transactions', 'client_id')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->unsignedBigInteger('client_id')->nullable()->after('id');
            });
            
            // Add foreign key for client_id
            Schema::table('transactions', function (Blueprint $table) {
                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            });
        }
        
        // Modify status column if it exists (change from string to enum), otherwise add it
        if (Schema::hasColumn('transactions', 'status')) {
            // Modify existing status column to enum using raw SQL
            DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM('PENDING', 'COMPLETED', 'CANCELLED', 'FAILED') NOT NULL DEFAULT 'PENDING'");
        } else {
            Schema::table('transactions', function (Blueprint $table) {
                $table->enum('status', ['PENDING', 'COMPLETED', 'CANCELLED', 'FAILED'])->default('PENDING')->after('type');
            });
        }
        
        // Add other columns if they don't exist
        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'description')) {
                $table->text('description')->nullable()->after('status');
            }
            
            if (!Schema::hasColumn('transactions', 'reference')) {
                $table->string('reference')->nullable()->after('description');
            }
            
            // Modify merchant_trade_no if it exists
            if (Schema::hasColumn('transactions', 'merchant_trade_no')) {
                $table->string('merchant_trade_no')->nullable()->change();
            }
        });
        
        // Add index if columns exist (try-catch in case index already exists)
        if (Schema::hasColumn('transactions', 'client_id')) {
            try {
                Schema::table('transactions', function (Blueprint $table) {
                    $table->index(['client_id', 'type', 'status'], 'transactions_client_id_type_status_index');
                });
            } catch (\Exception $e) {
                // Index might already exist, continue
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropIndex(['client_id', 'type', 'status']);
            $table->dropColumn(['client_id', 'status', 'description', 'reference']);
        });
    }
};

