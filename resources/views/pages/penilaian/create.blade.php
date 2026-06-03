@extends('layouts.app')
@section('content')
    <div class="page-heading">

        <!-- HEADING -->
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <!-- KIRI -->
                    <div>

                        <h2 class="fw-bold mb-1 text-primary">
                            Penilaian Alternatif
                        </h2>

                        <p class="text-muted mb-0">
                            Form penilaian calon penerima bantuan RASTRADA
                        </p>

                    </div>

                    <!-- KANAN -->
                    <div class="text-md-end mt-3 mt-md-0">

                        <span class="badge bg-primary fs-6 px-3 py-2">
                            {{ $penduduk->nama }}
                        </span>

                        <div class="small text-muted mt-2">

                            NIK :
                            {{ $penduduk->nik }}

                        </div>

                        <div class="small text-muted">

                            Periode :
                            {{ date('F Y') }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <form action="/penilaian/store" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="penduduk_id" value="{{ $penduduk->id }}">
            <input type="hidden" name="periode_id" value="{{ $periode_id }}">            @foreach ($kriteria as $k)
                <div class="card mb-3">
                    <div class="card-body">
                        <label><strong>{{ $k->nama_kriteria }}</strong></label>

                        <select name="subkriteria[{{ $k->id }}]" class="form-control">
                            <option value="">-- Pilih --</option>
                            @foreach ($k->subkriteria as $sub)
                                <option value="{{ $sub->id }}">
                                    {{ $sub->label_subkriteria }} ({{ $sub->nilai }})
                                </option>
                            @endforeach
                        </select>

                        <div class="mt-2">
                            <label>Bukti (foto/file)</label>
                            <input type="file" name="bukti[{{ $k->id }}]" class="form-control">
                        </div>
                        <div class="mt-2">
                            <label>Catatan</label>
                            <textarea name="catatan[{{ $k->id }}]" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/penilaian" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
