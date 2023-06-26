<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrasaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('doc_no')->nullable();
            $table->string('token')->nullable();
            $table->date('date')->nullable();
            $table->string('gateway')->nullable(); //xendit
            $table->string('type')->nullable(); //
            $table->string('method')->nullable(); //
            $table->text('invoice_url')->nullable(); //
            $table->integer('total_quantity')->default(0);
            $table->double('sub_total')->default(0);
            $table->double('grand_total')->default(0);
            $table->text('description')->nullable();
            $table->string('status')->default('CREATED');
            $table->timestamps();
        });

        Schema::create('transaction_destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->nullable();
            $table->integer('region_id')->nullable();
            $table->string('email')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->tinyInteger('is_user')->default(0);
            $table->timestamps();

            $table->foreign('region_id')->references('region_id')->on('regions');
            $table->foreign('email')->references('email')->on('users');
        });

        Schema::create('transaction_shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->nullable();
            $table->string('shipping_waybill')->nullable();
            $table->string('shipping_method')->nullable();
            $table->double('shipping_cost')->default(0);
            $table->integer('origin_ro_id')->default(151);
            $table->integer('destination_ro_id')->default(0);
            $table->string('status')->default('DIKEMAS');
            $table->timestamps();
        });

        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained();
            $table->foreignId('product_detail_id')->constrained();
            $table->integer('quantity')->default(0);
            $table->double('price')->default(0);
            $table->timestamps();
        });

        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->nullable();
            $table->foreignId('transaction_history_id')->constrained()->nullable();
            $table->text('response_raw')->nullable();
            $table->string('response_status')->nullable();
            $table->string('response_code')->nullable();
            $table->string('response_message')->nullable();
            $table->string('created_by')->default('SUPER ADMIN');
            $table->string('updated_by')->default('ADMINISTRATOR');
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
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('transaction_destinations');
        Schema::dropIfExists('transaction_items');
        Schema::dropIfExists('transaction_histories');
        Schema::dropIfExists('transaction_shippings');
    }
}
