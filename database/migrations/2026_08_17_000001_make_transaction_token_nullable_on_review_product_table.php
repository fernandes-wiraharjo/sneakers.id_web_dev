<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeTransactionTokenNullableOnReviewProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('review_product', function (Blueprint $table) {
            $table->string('transaction_token')->nullable()->change();
            $table->string('reviewer_name')->nullable()->after('transaction_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_product', function (Blueprint $table) {
            $table->dropColumn('reviewer_name');
            $table->string('transaction_token')->nullable(false)->change();
        });
    }
}
