<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('payment_id'); // Payment ID
            $table->string('payment_status'); // Status
            $table->string('pay_address'); // Pay address
            $table->decimal('price_amount', 15, 2); // Price amount
            $table->string('price_currency'); // Currency for price
            $table->decimal('pay_amount', 18, 8); // Amount in pay currency
            $table->string('pay_currency'); // Pay currency
            $table->string('order_id'); // Order ID
            $table->text('order_description'); // Order description
            $table->string('ipn_callback_url'); // IPN Callback URL
            $table->string('purchase_id'); // Purchase ID
            $table->decimal('amount_received', 18, 8)->nullable(); // Amount received (nullable)
            $table->string('payin_extra_id')->nullable(); // Payin extra ID (nullable)
            $table->string('smart_contract')->nullable(); // Smart contract (nullable)
            $table->string('network'); // Network (e.g., BTC)
            $table->integer('network_precision'); // Precision of the network (usually 8 for BTC)
            $table->timestamp('expiration_estimate_date')->nullable(); // Expiration estimate date
            $table->decimal('burning_percent', 5, 2)->nullable(); // Burning percent (nullable)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
