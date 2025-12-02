<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizeFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Main size_filters table
        Schema::create('size_filters', function (Blueprint $table) {
            $table->id();
            $table->string('filter_label'); // e.g., "42"
            $table->integer('sort_order')->default(0); // For custom ordering
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Pivot table for size_filter and sizes relationship
        Schema::create('size_filter_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('size_filter_id')->constrained('size_filters')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
            $table->timestamps();
            
            // Unique constraint to prevent duplicate entries
            $table->unique(['size_filter_id', 'size_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('size_filter_sizes');
        Schema::dropIfExists('size_filters');
    }
}
