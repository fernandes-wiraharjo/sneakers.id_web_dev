<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_address', function (Blueprint $table) {
            if (Schema::hasColumn('user_address', 'region_id')) {
                $table->integer('region_id')->nullable()->change();
            }

            if (! Schema::hasColumn('user_address', 'province')) {
                $table->string('province')->nullable()->after('region_id');
            }

            if (! Schema::hasColumn('user_address', 'city')) {
                $table->string('city')->nullable()->after('province');
            }

            if (! Schema::hasColumn('user_address', 'district')) {
                $table->string('district')->nullable()->after('city');
            }

            if (! Schema::hasColumn('user_address', 'subdistrict')) {
                $table->string('subdistrict')->nullable()->after('district');
            }

            if (! Schema::hasColumn('user_address', 'postal_code')) {
                $table->string('postal_code', 20)->nullable()->after('subdistrict');
            }

            if (! Schema::hasColumn('user_address', 'subdistrict_ro_id')) {
                $table->unsignedBigInteger('subdistrict_ro_id')->nullable()->after('postal_code');
            }
        });
    }

    public function down(): void
    {
        Schema::table('user_address', function (Blueprint $table) {
            $columns = ['province', 'city', 'district', 'subdistrict', 'postal_code', 'subdistrict_ro_id'];
            $existing = array_filter($columns, fn ($column) => Schema::hasColumn('user_address', $column));

            if (! empty($existing)) {
                $table->dropColumn($existing);
            }
        });
    }
};
