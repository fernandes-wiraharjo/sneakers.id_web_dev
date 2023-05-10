<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMenSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('men_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('size_id')->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('US')->nullable();
            $table->string('UK')->nullable();
            $table->string('EU')->nullable();
            $table->string('CM')->nullable();
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
        Schema::dropIfExists('men_sizes');
    }
}
