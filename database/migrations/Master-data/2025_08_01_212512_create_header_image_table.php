<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_images', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name');
            $table->string('menu_parent_name');
            $table->string('image_url');
            $table->tinyInteger('is_active');
            $table->timestamps();

            $table->unique(['menu_parent_name', 'menu_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('header_images');
    }
}
