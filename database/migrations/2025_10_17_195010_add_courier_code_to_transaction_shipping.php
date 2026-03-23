<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourierCodeToTransactionShipping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_shippings', function (Blueprint $table) {
            $table->string('courier_code')->nullable()->after('transaction_id');

            $table->foreign('courier_code')->references('code')->on('shipping_couriers');
            $table->foreign('origin_ro_id')->references('region_id')->on('regions');
            $table->foreign('destination_ro_id')->references('region_id')->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_shippings', function (Blueprint $table) {
            $table->dropForeign(['courier_code']);
            $table->dropForeign(['origin_ro_id']);
            $table->dropForeign(['destination_ro_id']);
            
            $table->dropColumn('courier_code');
        });
    }
}
