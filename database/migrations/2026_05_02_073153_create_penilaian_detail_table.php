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
        Schema::create('penilaian_detail', function (Blueprint $table) {
            $table->id();

            $table->foreignId('penilaian_id')
                ->constrained('penilaian')
                ->onDelete('cascade');

            $table->foreignId('kriteria_id')
                ->constrained('kriteria')
                ->onDelete('cascade');

            $table->foreignId('subkriteria_id')
                ->constrained('subkriteria')
                ->onDelete('cascade');

            $table->integer('nilai');
            $table->string('bukti_file')->nullable();
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_detail');
    }
};
