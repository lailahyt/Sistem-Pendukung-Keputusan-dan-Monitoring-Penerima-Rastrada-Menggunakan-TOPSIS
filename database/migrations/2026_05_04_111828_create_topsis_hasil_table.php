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
        Schema::create('topsis_hasil', function (Blueprint $table) {
            $table->id();

            $table->foreignId('periode_id')
                ->constrained('periode')
                ->onDelete('cascade');

            $table->foreignId('penduduk_id')
                ->constrained('residents')
                ->onDelete('cascade');

            $table->double('nilai_preferensi');
            $table->integer('ranking');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topsis_hasil');
    }
};
