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
        Schema::create('bantuan_lain', function (Blueprint $table) {
            $table->id();

            $table->foreignId('penduduk_id')
                ->constrained('residents')
                ->cascadeOnDelete();

            $table->string('nama_bantuan', 100);

            $table->year('tahun');

            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->unique([
                'penduduk_id',
                'nama_bantuan',
                'tahun'
            ], 'bantuan_lain_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bantuan_lain');
    }
};
