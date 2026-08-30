<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instagram_connections', function (Blueprint $table) {
            $table->id();
            $table->string('facebook_user_id')->nullable();
            $table->string('facebook_page_id');
            $table->string('facebook_page_name')->nullable();
            $table->string('instagram_business_account_id');
            $table->string('instagram_username')->nullable();
            $table->text('access_token');
            $table->timestamp('token_expires_at')->nullable();
            $table->unsignedBigInteger('connected_by_user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instagram_connections');
    }
};
