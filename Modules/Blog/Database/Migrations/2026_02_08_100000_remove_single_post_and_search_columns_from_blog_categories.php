<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSinglePostAndSearchColumnsFromBlogCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn([
                'is_show_single_post',
                'sequence_single_post',
                'is_show_search',
                'sequence_search'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->boolean('is_show_single_post')->default(true)->after('sequence');
            $table->integer('sequence_single_post')->after('is_show_single_post');
            $table->boolean('is_show_search')->default(true)->after('sequence_single_post');
            $table->integer('sequence_search')->after('is_show_search');
        });
    }
}
