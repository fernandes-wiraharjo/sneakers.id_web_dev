<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePriceDiscountToPriceVoucherInReportPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     * Renames price_discount to price_voucher for existing installs (avoids confusion with product discount).
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('report_purchase', 'price_discount')) {
            Schema::table('report_purchase', function (Blueprint $table) {
                $table->renameColumn('price_discount', 'price_voucher');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('report_purchase', 'price_voucher')) {
            Schema::table('report_purchase', function (Blueprint $table) {
                $table->renameColumn('price_voucher', 'price_discount');
            });
        }
    }
}
