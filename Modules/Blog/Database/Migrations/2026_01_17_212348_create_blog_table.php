<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->boolean('is_show_home')->default(false);
            $table->integer('sequence');
            $table->boolean('is_show_single_post')->default(true);
            $table->integer('sequence_single_post');
            $table->boolean('is_show_search')->default(true);
            $table->integer('sequence_search');
            $table->timestamps();
        });

        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->index();
            $table->string('title')->index();
            $table->string('category_id')->nullable();
            $table->text('content');
            $table->text('plain_text')->index();
            $table->string('featured_image_url');
            $table->string('author');
            $table->boolean('is_carousel')->default(false);
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedBigInteger('visitor_count')->default(0)->index();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('set null');
        });

        DB::table('blog_categories')->insert([
            [
                'id' => 'promo',
                'name' => 'Promo sneakers.id',
                'is_show_home' => true,
                'sequence' => 1,
                'is_show_single_post' => true,
                'sequence_single_post' => 1,
                'is_show_search' => true,
                'sequence_search' => 1,
            ],
            [
                'id' => 'news',
                'name' => 'News',
                'is_show_home' => true,
                'sequence' => 2,
                'is_show_single_post' => true,
                'sequence_single_post' => 2,
                'is_show_search' => true,
                'sequence_search' => 2,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog');
        Schema::dropIfExists('blog_categories');
    }
}
