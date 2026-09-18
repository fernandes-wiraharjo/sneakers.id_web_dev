<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApplyToToDiscountVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discount_vouchers', function (Blueprint $table) {
            if (! Schema::hasColumn('discount_vouchers', 'apply_to')) {
                $table->enum('apply_to', ['shipping', 'product', 'cart'])
                    ->default('cart')
                    ->after('min_purchase')
                    ->comment('Where the discount is applied: shipping, product total, or entire cart');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discount_vouchers', function (Blueprint $table) {
            if (Schema::hasColumn('discount_vouchers', 'apply_to')) {
                $table->dropColumn('apply_to');
            }
        });
    }
}
