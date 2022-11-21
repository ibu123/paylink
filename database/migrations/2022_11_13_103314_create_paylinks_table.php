<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaylinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paylinks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('merchants', 'id');
            $table->unsignedBigInteger('amount');
            $table->dateTime('expiration_date'); //YYYY-MM-DD hh:mm:ss
            $table->dateTime('paid_date')->nullable();
            $table->dateTime('send_paid_date')->nullable();
            $table->text('order_id');
            $table->text('checkout_url');
            $table->text('notes');
            $table->string('card')->nullable();
            $table->float('commission_percentage', $precision = 5, $scale = 4)->nullable();
            $table->float('commission', $precision = 8, $scale = 4)->nullable();
            $table->tinyInteger('payment_status')->comment("0 = cancel, 1 = awaiting payment, 2 = paid ");
            $table->tinyInteger('send_payment_status')->comment("0 = cancel, 1 = awaiting payment, 2 = paid ");
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
        Schema::dropIfExists('paylinks');
    }
}
