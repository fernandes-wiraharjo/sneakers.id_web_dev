<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_code', 50)->unique();
            $table->date('valid_from');
            $table->date('valid_until');
            $table->double('min_purchase')->default(0);
            $table->enum('discount_type', ['percent', 'fixed_amount'])->default('percent');
            $table->decimal('discount_rate', 5, 2)->nullable()->comment('Percentage value (0-100)');
            $table->double('discount_amount')->nullable()->comment('Fixed amount discount or max amount for percentage type');
            $table->integer('quota_total')->default(0)->comment('0 for unlimited');
            $table->integer('quota_per_user')->default(1);
            $table->integer('usage_count')->default(0)->comment('Track how many times voucher has been used');
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });

        Schema::create('discount_voucher_usage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_voucher_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('transaction_id')->nullable()->constrained()->onDelete('set null');
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
        Schema::dropIfExists('discount_voucher_usage');
        Schema::dropIfExists('discount_vouchers');
    }
}

