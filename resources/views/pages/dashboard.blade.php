@extends('layouts.app')

@section('content')
    <div class="page-heading">

        <h3>Dashboard Admin</h3>

    </div>

    <div class="page-content">

        <section class="row">

            {{-- LEFT CONTENT --}}
            <div class="col-12 col-lg-9">

                {{-- STATISTIK --}}
                <div class="row g-4">

                    {{-- TOTAL PENDUDUK --}}
                    <div class="col-12 col-md-6 col-lg-3">

                        <div class="card shadow-sm border-0">

                            <div class="card-body">

                                <div class="d-flex align-items-center justify-content-between">

                                    <div class="bg-primary bg-opacity-10 p-2 rounded-4">

                                        <i class="bi bi-people-fill text-primary fs-2"></i>

                                    </div>

                                    <div class="text-end">

                                        <h6 class="text-muted mb-1">
                                            Total Penduduk
                                        </h6>

                                        <h3 class="fw-bold mb-0">
                                            {{ $totalPenduduk }}
                                        </h3>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- TOTAL PENERIMA --}}
                    <div class="col-12 col-md-6 col-lg-3">

                        <div class="card shadow-sm border-0">

                            <div class="card-body">

                                <div class="d-flex align-items-center justify-content-between">

                                    <div class="bg-info bg-opacity-10 p-2 rounded-4">

                                        <i class="bi bi-person-check-fill text-info fs-2"></i>

                                    </div>

                                    <div class="text-end">

                                        <h6 class="text-muted mb-1">
                                            Total Penerima
                                        </h6>

                                        <h3 class="fw-bold mb-0">
                                            {{ $totalPenerima }}
                                        </h3>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- SUDAH AMBIL --}}
                    <div class="col-12 col-md-6 col-lg-3">

                        <div class="card shadow-sm border-0">

                            <div class="card-body">

                                <div class="d-flex align-items-center justify-content-between">

                                    <div class="bg-success bg-opacity-10 p-2 rounded-4">

                                        <i class="bi bi-check-circle-fill text-success fs-2"></i>

                                    </div>

                                    <div class="text-end">

                                        <h6 class="text-muted mb-1">
                                            Sudah Ambil
                                        </h6>

                                        <h3 class="fw-bold mb-0">
                                            {{ $sudahAmbil }}
                                        </h3>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- BELUM AMBIL --}}
                    <div class="col-12 col-md-6 col-lg-3">

                        <div class="card shadow-sm border-0">

                            <div class="card-body">

                                <div class="d-flex align-items-center justify-content-between">

                                    <div class="bg-danger bg-opacity-10 p-2 rounded-4">

                                        <i class="bi bi-exclamation-triangle-fill text-danger fs-2"></i>

                                    </div>

                                    <div class="text-end">

                                        <h6 class="text-muted mb-1">
                                            Belum Ambil
                                        </h6>

                                        <h3 class="fw-bold mb-0">
                                            {{ $belumAmbil }}
                                        </h3>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- PROGRESS DISTRIBUSI --}}
                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-header">

                                <h4>
                                    Progress Distribusi Bantuan
                                </h4>

                            </div>

                            <div class="card-body">

                                <div class="d-flex justify-content-between mb-2">

                                    <span class="fw-bold">
                                        Realisasi Distribusi
                                    </span>

                                    <span class="text-muted">
                                        {{ number_format($realisasi, 1) }}%
                                    </span>

                                </div>

                                <div class="progress" style="height:12px">

                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $realisasi }}%">

                                    </div>

                                </div>

                                <div class="mt-3">

                                    <small class="text-muted">

                                        {{ $sudahAmbil }}
                                        dari
                                        {{ $totalPenerima }}
                                        penerima sudah mengambil bantuan.

                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- TOP RANKING --}}
                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-header">

                                <h4>
                                    Top Ranking TOPSIS
                                </h4>

                            </div>

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-hover table-lg">

                                        <thead>

                                            <tr>

                                                <th>Rank</th>
                                                <th>Nama</th>
                                                <th>Nilai Vi</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @forelse ($topRanking as $item)
                                                <tr>

                                                    <td>

                                                        <span class="badge bg-warning text-dark">

                                                            #{{ $item->rank }}

                                                        </span>

                                                    </td>

                                                    <td class="fw-bold">

                                                        {{ $item->resident->nama ?? '-' }}

                                                    </td>

                                                    <td>

                                                        {{ number_format($item->nilai_preferensi, 3) }}

                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>

                                                    <td colspan="3" class="text-center text-muted">

                                                        Tidak ada data ranking

                                                    </td>

                                                </tr>
                                            @endforelse

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT CONTENT --}}
            <div class="col-12 col-lg-3">

                {{-- PROFILE ADMIN --}}
                <div class="card">

                    <div class="card-body py-4 px-4">

                        <div class="d-flex align-items-center">

                            <div class="avatar avatar-xl">

                                <img src="{{ asset('assets/compiled/jpg/1.jpg') }}" alt="Admin">

                            </div>

                            <div class="ms-3 name">

                                <h5 class="font-bold">
                                    {{ auth()->user()->name }}
                                </h5>

                                <h6 class="text-muted mb-0">

                                    {{ auth()->user()?->role?->nama_role ?? 'Admin' }}

                                </h6>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- INFO PERIODE --}}
                <div class="card">

                    <div class="card-header">

                        <h4>
                            Periode Aktif
                        </h4>

                    </div>

                    <div class="card-body">

                        <h5 class="fw-bold">

                            {{ $periode->nama_periode ?? '-' }}

                        </h5>

                        <p class="text-muted mb-0">

                            Sistem monitoring distribusi bantuan Rastrada.

                        </p>

                    </div>

                </div>

                {{-- STATUS DISTRIBUSI --}}
                <div class="card">

                    <div class="card-header">

                        <h4>
                            Status Distribusi
                        </h4>

                    </div>

                    <div class="card-body">

                        <div class="mb-3">

                            <div class="d-flex justify-content-between">

                                <span>Sudah Ambil</span>

                                <span class="fw-bold text-success">

                                    {{ $sudahAmbil }}

                                </span>

                            </div>

                        </div>

                        <div>

                            <div class="d-flex justify-content-between">

                                <span>Belum Ambil</span>

                                <span class="fw-bold text-danger">

                                    {{ $belumAmbil }}

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>
@endsection
