<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveEmailForeignKeyFromTransactionDestinations extends Migration
{
    /**
     * Run the migrations.
     * Remove email foreign key to allow guest checkout
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_destinations', function (Blueprint $table) {
            // Drop foreign key constraint on email
            // This allows guest users (who don't have an account) to place orders
            $table->dropForeign(['email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_destinations', function (Blueprint $table) {
            // Re-add foreign key constraint on email
            $table->foreign('email')->references('email')->on('users');
        });
    }
}
