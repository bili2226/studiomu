<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->json('addons')->nullable()->after('col2');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->json('addons')->nullable()->after('requests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('addons');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('addons');
        });
    }
};
