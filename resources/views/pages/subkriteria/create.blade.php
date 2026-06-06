@extends('layouts.app')
@section('content')
    <div class="page-heading">

        <!-- Judul -->
        <h3>Tambah Subkriteria</h3>
        <p class="text-subtitle text-muted">
            {{ $kriteria->kode }} — {{ $kriteria->nama_kriteria }}
        </p>

        <section class="section">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title">Form Input Subkriteria</h5>
                </div>

                <div class="card-body">
                    <form action="/kriteria/{{ $kriteria->id }}/subkriteria" method="POST">
                        @csrf

                        <div class="row">

                            <!-- Kriteria (readonly) -->
                            <div class="col-md-6 mb-3">
                                <label>Kriteria</label>
                                <input type="text" class="form-control" value="{{ $kriteria->nama_kriteria }}" readonly>
                            </div>

                            <!-- Label Subkriteria -->
                            <div class="col-md-6 mb-3">
                                <label>Label Subkriteria</label>
                                <input type="text" name="label_subkriteria" class="form-control" required>
                            </div>

                            <!-- Nilai -->
                            <div class="col-md-6 mb-3">
                                <label>Nilai</label>
                                <input type="number" name="nilai" class="form-control" min="1" max="5"
                                    placeholder="Range 1 - 5" required>
                            </div>

                            <!-- Keterangan -->
                            <div class="col-md-6 mb-3">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" class="form-control" placeholder="Opsional">
                            </div>

                        </div>

                        <!-- Hidden FK -->
                        <input type="hidden" name="kriteria_id" value="{{ $kriteria->id }}">

                        <div class="mt-3 d-flex justify-content-end gap-2">
                            <a href="/kriteria/{{ $kriteria->id }}/subkriteria" class="btn btn-outline-secondary me-1 mb-1">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
