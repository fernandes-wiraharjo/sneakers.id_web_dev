<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_purchase', function (Blueprint $table) {
            $table->id()->from(10000);
            $table->string('order_id')->index();
            $table->date('transaction_date')->index();
            $table->string('customer_name')->index();
            $table->string('transaction_type')->default('WEB')->index();
            $table->string('location')->nullable();
            $table->string('article_number')->nullable();
            $table->string('product_name')->nullable();
            $table->string('size')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('price_ongkir')->nullable();
            $table->integer('price_modal')->nullable();
            $table->integer('price_jual')->nullable();
            $table->integer('price_voucher')->nullable();
            $table->integer('price_total_payment')->nullable();
            $table->integer('dp_owner')->nullable();
            $table->integer('dp_supplier')->nullable();
            $table->integer('sisa_owner')->nullable();
            $table->integer('sisa_supplier')->nullable();
            $table->enum('status_owner', ['belum lunas', 'lunas', 'sebagian'])->nullable();
            $table->enum('status_supplier', ['belum lunas', 'lunas', 'sebagian'])->nullable();
            $table->integer('margin_net')->nullable();
            $table->integer('modal_net')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('awb_number')->nullable();

            $table->timestamps();
        });

        Schema::create('report_purchase_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_purchase_id')->constrained('report_purchase');
            $table->json('data_before')->nullable();
            $table->json('data_after')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('report_purchase_history');
        Schema::dropIfExists('report_purchase');
    }
}
