<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('total_weight')->after('total_quantity')->default(0)->nullable()->comment('in grams;');
        });

        Schema::table('transaction_shippings', function (Blueprint $table) {
            $table->integer('shipping_weight')->after('shipping_cost')->default(0)->nullable()->comment('in grams;');
        });

        Schema::table('transaction_items', function (Blueprint $table) {
            $table->integer('weight')->after('quantity')->default(0)->nullable()->comment('in grams;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('total_weight');
        });

        Schema::table('transaction_shippings', function (Blueprint $table) {
            $table->dropColumn('shipping_weight');
        });

        Schema::table('transaction_items', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
    }
}
