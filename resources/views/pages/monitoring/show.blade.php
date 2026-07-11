@extends('layouts.app')

@section('content')
    <div class="page-heading">

        <div class="page-title mb-4">

            <div class="row">

                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Distribusi</h3>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">

                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="/monitoring">Monitoring</a>
                            </li>

                            <li class="breadcrumb-item active">
                                Detail
                            </li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

        <section class="section">

            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">
                        Informasi Distribusi Bantuan
                    </h4>
                </div>

                <div class="card-body">

                    {{-- INFO PENERIMA --}}
                    <div class="row mb-4 p-3 border rounded">

                        <div class="col-md-12 mb-3">

                            <h5 class="fw-bold mb-1">
                                {{ $monitoring->resident->nama }}
                            </h5>

                            <span class="text-muted">
                                NIK:
                                {{ $monitoring->resident->nik }}
                            </span>

                        </div>

                        <div class="col-md-3">

                            <label class="fw-bold">
                                Ranking TOPSIS
                            </label>

                            <p>
                                #{{ $monitoring->rank }}
                            </p>

                        </div>

                        <div class="col-md-3">

                            <label class="fw-bold">
                                Nilai Preferensi
                            </label>

                            <p>
                                {{ number_format($monitoring->nilai_preferensi, 4) }}
                            </p>

                        </div>

                        <div class="col-md-3">

                            <label class="fw-bold">
                                Status Distribusi
                            </label>

                            <p>

                                @if ($monitoring->status_pengambilan == 'sudah_ambil')
                                    <span class="badge bg-success">
                                        Sudah Ambil
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        Belum Ambil
                                    </span>
                                @endif

                            </p>

                        </div>

                        <div class="col-md-3">

                            <label class="fw-bold">
                                Petugas
                            </label>

                            <p>
                                {{ $monitoring->petugas ?? '-' }}
                            </p>

                        </div>

                    </div>

                    {{-- DETAIL DISTRIBUSI --}}
                    <div class="row mb-4 p-3 border rounded">

                        <div class="col-md-6 mb-3">

                            <label class="fw-bold">
                                Tanggal Pengambilan
                            </label>

                            <p>

                                @if ($monitoring->tanggal_ambil)
                                    {{ \Carbon\Carbon::parse($monitoring->tanggal_ambil)->format('d M Y H:i') }}
                                @else
                                    -
                                @endif

                            </p>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="fw-bold">
                                Diambil Oleh
                            </label>

                            <p>
                                {{ $monitoring->diambil_oleh ?? '-' }}
                            </p>

                        </div>

                        <div class="col-md-12">

                            <label class="fw-bold">
                                Catatan
                            </label>

                            <div class="border rounded p-3 bg-light">

                                {{ $monitoring->catatan ?? 'Tidak ada catatan' }}

                            </div>

                        </div>

                    </div>

                    {{-- BUKTI --}}
                    <div class="row p-3 border rounded">

                        {{-- FOTO KTP --}}
                        <div class="col-md-6 mb-4">

                            <label class="fw-bold mb-3">
                                Bukti Identitas Penerima (KTP)
                            </label>

                            <br>

                            @if ($monitoring->foto_ktp)
                                <img src="{{ asset('storage/' . $monitoring->foto_ktp) }}" class="img-fluid rounded border"
                                    style="max-height:400px;">
                            @else
                                <div class="alert alert-light-warning">
                                    Foto KTP belum tersedia
                                </div>
                            @endif

                        </div>

                        {{-- FOTO DISTRIBUSI --}}
                        <div class="col-md-6 mb-4">

                            <label class="fw-bold mb-3">
                                Bukti Penyaluran Bantuan RASTRADA
                            </label>

                            <br>

                            @if ($monitoring->bukti_distribusi)
                                <img src="{{ asset('storage/' . $monitoring->bukti_distribusi) }}"
                                    class="img-fluid rounded border" style="max-height:400px;">
                            @else
                                <div class="alert alert-light-warning">
                                    Foto distribusi belum tersedia
                                </div>
                            @endif

                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="mt-4">
                        <div class="col-12 d-flex justify-content-end">

                            <a href="/monitoring" class="btn btn-secondary">

                                Kembali

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>
@endsection
