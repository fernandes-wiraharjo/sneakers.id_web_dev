<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaction_destinations', function (Blueprint $table) {
            if (Schema::hasColumn('transaction_destinations', 'region_id')) {
                $table->integer('region_id')->nullable()->change();
            }

            if (! Schema::hasColumn('transaction_destinations', 'province')) {
                $table->string('province')->nullable()->after('region_id');
            }

            if (! Schema::hasColumn('transaction_destinations', 'city')) {
                $table->string('city')->nullable()->after('province');
            }

            if (! Schema::hasColumn('transaction_destinations', 'district')) {
                $table->string('district')->nullable()->after('city');
            }

            if (! Schema::hasColumn('transaction_destinations', 'subdistrict')) {
                $table->string('subdistrict')->nullable()->after('district');
            }

            if (! Schema::hasColumn('transaction_destinations', 'postal_code')) {
                $table->string('postal_code', 20)->nullable()->after('subdistrict');
            }

            if (! Schema::hasColumn('transaction_destinations', 'subdistrict_ro_id')) {
                $table->unsignedBigInteger('subdistrict_ro_id')->nullable()->after('postal_code');
            }
        });
    }

    public function down(): void
    {
        Schema::table('transaction_destinations', function (Blueprint $table) {
            $columns = ['province', 'city', 'district', 'subdistrict', 'postal_code', 'subdistrict_ro_id'];
            $existing = array_filter($columns, fn ($column) => Schema::hasColumn('transaction_destinations', $column));

            if (! empty($existing)) {
                $table->dropColumn($existing);
            }
        });
    }
};
