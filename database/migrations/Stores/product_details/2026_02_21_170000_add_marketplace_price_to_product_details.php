<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarketplacePriceToProductDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_details', function (Blueprint $table) {
            $table->integer('marketplace_price')->nullable()->after('discount_percentage');
            $table->double('marketplace_after_discount_price', 20, 2)->nullable()->after('marketplace_price');
            $table->integer('marketplace_discount_percentage')->nullable()->after('marketplace_after_discount_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_details', function (Blueprint $table) {
            $table->dropColumn(['marketplace_price', 'marketplace_after_discount_price', 'marketplace_discount_percentage']);
        });
    }
}
