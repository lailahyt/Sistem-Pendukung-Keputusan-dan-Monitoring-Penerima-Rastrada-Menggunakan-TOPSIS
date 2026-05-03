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
        Schema::table('penilaian', function (Blueprint $table) {
            $table->year('periode')->after('penduduk_id');
            $table->unique(['penduduk_id', 'periode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian', function (Blueprint $table) {
            //
        });
    }
};
