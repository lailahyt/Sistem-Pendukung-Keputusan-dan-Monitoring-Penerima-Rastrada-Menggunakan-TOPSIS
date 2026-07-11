<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('periode', function (Blueprint $table) {
            $table->integer('kuota')->nullable()->after('tahun');
        });
    }

    public function down(): void
    {
        Schema::table('periode', function (Blueprint $table) {
            $table->dropColumn('kuota');
        });
    }
};
