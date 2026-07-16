<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('residents', function (Blueprint $table) {

            $table->enum('status_pengajuan', [
                'belum_diajukan',
                'diajukan'
            ])->default('belum_diajukan')
                ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {

            $table->dropColumn('status_pengajuan');
        });
    }
};
