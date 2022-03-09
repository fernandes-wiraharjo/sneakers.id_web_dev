<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookBookImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('look_book_images', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('look_book_id')->constrained();
        //     $table->text('image_url')->nullable();
        //     $table->boolean('is_active')->default(1);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('look_book_images');
    }
}
