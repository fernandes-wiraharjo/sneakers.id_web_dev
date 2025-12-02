<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorSizeFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop old tables first
        Schema::dropIfExists('size_filter_sizes');
        Schema::dropIfExists('size_filters');

        // Create new size_filters table with JSON column for EU sizes
        Schema::create('size_filters', function (Blueprint $table) {
            $table->id();
            $table->string('filter_label'); // e.g., "42.5"
            $table->json('eu_sizes'); // Array of manually inputted EU sizes (e.g., ["42 1/3", "42.5"])
            $table->integer('sort_order')->default(0); // For custom ordering
            $table->boolean('is_active')->default(true);
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
        // Drop new table
        Schema::dropIfExists('size_filters');

        // Recreate old structure if needed for rollback
        Schema::create('size_filters', function (Blueprint $table) {
            $table->id();
            $table->string('filter_label');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('size_filter_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('size_filter_id')->constrained('size_filters')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['size_filter_id', 'size_id']);
        });
    }
}

