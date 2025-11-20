<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVoucherFieldsToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('discount_voucher_id')->nullable()->after('grand_total')->constrained('discount_vouchers')->onDelete('set null');
            $table->string('voucher_code', 50)->nullable()->after('discount_voucher_id');
            $table->double('voucher_discount')->nullable()->after('voucher_code')->comment('Discount amount applied from voucher');
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
            $table->dropForeign(['discount_voucher_id']);
            $table->dropColumn(['discount_voucher_id', 'voucher_code', 'voucher_discount']);
        });
    }
}
