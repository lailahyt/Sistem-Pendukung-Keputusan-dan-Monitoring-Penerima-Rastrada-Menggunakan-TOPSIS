<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monitoring_distribusi', function (Blueprint $table) {

            $table->id();

            // Relasi Penduduk
            $table->foreignId('penduduk_id')
                ->constrained('residents')
                ->onDelete('cascade');

            // Relasi Periode
            $table->foreignId('periode_id')
                ->constrained('periode')
                ->onDelete('cascade');

            // Ranking TOPSIS
            $table->integer('rank')->nullable();

            // Nilai preferensi
            $table->double('nilai_preferensi')->nullable();

            // Status distribusi
            $table->enum('status_pengambilan', [
                'belum_ambil',
                'sudah_ambil',
                'ditunda'
            ])->default('belum_ambil');

            // Tanggal distribusi
            $table->datetime('tanggal_ambil')->nullable();

            // Diambil oleh
            $table->string('diambil_oleh')->nullable();

            // Petugas distribusi
            $table->string('petugas')->nullable();

            // Bukti distribusi
            $table->string('bukti_distribusi')->nullable();

            // Catatan
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monitoring_distribusi');
    }
};
