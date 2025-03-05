<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id')->unique();
            $table->unsignedInteger('fee_id');
            $table->decimal('amount',10,2);
            $table->string('transaction_status')->nullable()->comment('PENDING,FAILED,SUCCESS');
            $table->string('transaction_ref_no')->unique()->nullable();
            $table->string('payment_type')->nullable()->comment("momo,bank,cheque");
            $table->string('payment_source',100)->nullable()->comment('momo,ussd or web');
            $table->string('cheque_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('cheque_date')->nullable();
            $table->string('card_no')->nullable();
            $table->string('cvv_code')->nullable();
            $table->string('card_expiry')->nullable();
            $table->string('server')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->dateTime('synched_on')->nullable();
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
};
