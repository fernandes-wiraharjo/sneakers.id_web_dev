<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instagram_connections', function (Blueprint $table) {
            $table->string('facebook_page_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('instagram_connections', function (Blueprint $table) {
            $table->string('facebook_page_id')->nullable(false)->change();
        });
    }
};
