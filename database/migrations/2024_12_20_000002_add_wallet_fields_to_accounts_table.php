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
        Schema::table('accounts', function (Blueprint $table) {
            $table->decimal('total_deposited', 15, 2)->default(0.00)->after('balance');
            $table->decimal('total_withdrawn', 15, 2)->default(0.00)->after('total_deposited');
            $table->decimal('total_invested', 15, 2)->default(0.00)->after('total_withdrawn');
            $table->decimal('total_profits', 15, 2)->default(0.00)->after('total_invested');
            $table->decimal('total_commissions', 15, 2)->default(0.00)->after('total_profits');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn([
                'total_deposited',
                'total_withdrawn',
                'total_invested',
                'total_profits',
                'total_commissions'
            ]);
        });
    }
};

