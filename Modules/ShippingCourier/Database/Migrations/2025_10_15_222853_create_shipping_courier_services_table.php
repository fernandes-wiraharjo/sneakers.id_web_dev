<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingCourierServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_courier_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_courier_id')->constrained('shipping_couriers')->onDelete('cascade');
            $table->string('code');  // Service code like 'CTC', 'REG', etc.
            $table->string('name');  // Service name
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            // Ensure unique service code per courier
            $table->unique(['shipping_courier_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_courier_services');
    }
}
