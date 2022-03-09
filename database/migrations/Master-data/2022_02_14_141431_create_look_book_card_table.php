<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookBookCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('look_book_cards', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('look_book_id')->constrained();
        //     $table->string('look_book_card_title');
        //     $table->string('look_book_card_description')->nullable();
        //     $table->string('look_book_card_url')->nullable();
        //     $table->text('image_url')->nullable();
        //     $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('look_book_cards');
    }
}
