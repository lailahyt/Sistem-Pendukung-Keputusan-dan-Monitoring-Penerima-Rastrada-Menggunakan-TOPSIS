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
        Schema::table('monitoring_distribusi', function (Blueprint $table) {

            $table->string('foto_ktp')
                ->nullable()
                ->after('petugas');
        });
    }

    public function down(): void
    {
        Schema::table('monitoring_distribusi', function (Blueprint $table) {

            $table->dropColumn('foto_ktp');
        });
    }
};
