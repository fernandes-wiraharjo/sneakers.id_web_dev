<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSignatureImageAndIsHomeDisplayToSignaturePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('signature_players', function (Blueprint $table) {
            $table->string('signature_image')->after('signature_description')->nullable();
            $table->tinyInteger('is_home_display')->after('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('signature_players', function (Blueprint $table) {
            $table->dropColumn(['signature_image', 'is_home_display']);
        });
    }
}
