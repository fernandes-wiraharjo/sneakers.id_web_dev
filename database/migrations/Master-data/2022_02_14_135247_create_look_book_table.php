<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('look_books', function (Blueprint $table) {
            $table->id();
            $table->string('look_book_title');
            $table->string('look_book_description')->nullable();
            $table->text('look_book_content')->nullable();
            $table->integer('look_book_order');
            $table->tinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('look_books');
    }
}
