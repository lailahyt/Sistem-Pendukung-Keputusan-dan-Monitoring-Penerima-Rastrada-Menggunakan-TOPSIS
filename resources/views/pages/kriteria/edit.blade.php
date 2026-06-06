@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <h3>Edit Data Kriteria</h3>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Edit Kriteria</h5>
                </div>

                <div class="card-body">
                    <form action="/kriteria/{{ $kriteria->kode }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Kode</label>
                                <input type="text" name="kode" class="form-control" value="{{ $kriteria->kode }}"
                                    readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Nama Kriteria</label>
                                <input type="text" name="nama_kriteria" class="form-control"
                                    value="{{ $kriteria->nama_kriteria }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Bobot</label>
                                <input type="number" step="0.01" name="bobot" class="form-control"
                                    value="{{ $kriteria->bobot }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Atribut</label>
                                <select name="atribut" class="form-control" required>
                                    <option value="benefit" {{ $kriteria->atribut == 'benefit' ? 'selected' : '' }}>
                                        Benefit
                                    </option>
                                    <option value="cost" {{ $kriteria->atribut == 'cost' ? 'selected' : '' }}>
                                        Cost
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Perlu Bukti</label>
                                <select name="butuh_bukti" class="form-control" required>
                                    <option value="1" {{ $kriteria->butuh_bukti ? 'selected' : '' }}>
                                        Ya
                                    </option>

                                    <option value="0" {{ !$kriteria->butuh_bukti ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                            </div>

                        </div>

                        <div class="mt-3 d-flex justify-content-end gap-2">
                            <a href="/penilaian" class="btn btn-outline-secondary me-1 mb-1">
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
