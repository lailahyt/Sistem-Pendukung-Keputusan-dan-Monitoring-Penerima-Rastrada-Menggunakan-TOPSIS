@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <h3>Tambah Data Kriteria</h3>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Input Kriteria</h5>
                </div>

                <div class="card-body">
                    <form action="/kriteria" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Kode Kriteria</label>
                                <input type="text" name="kode" class="form-control" placeholder="Contoh: C1" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Nama Kriteria</label>
                                <input type="text" name="nama_kriteria" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Bobot</label>
                                <input type="number" step="0.01" name="bobot" class="form-control"
                                    placeholder="Contoh: 0.30" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Tipe Atribut</label>
                                <select name="atribut" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="benefit">Benefit</option>
                                    <option value="cost">Cost</option>
                                </select>
                            </div>

                        </div>

                        <div class="mt-3 d-flex justify-content-end gap-2">
                            <a href="/kriteria" class="btn btn-outline-secondary me-1 mb-1">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>

                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
