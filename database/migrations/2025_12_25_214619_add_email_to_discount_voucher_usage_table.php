<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToDiscountVoucherUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discount_voucher_usage', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->string('email')->nullable()->after('user_id');
            $table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discount_voucher_usage', function (Blueprint $table) {
            // Re-add user_id column
            $table->foreignId('user_id')->after('discount_voucher_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Remove email column
            $table->dropColumn('email');
        });
    }
}
