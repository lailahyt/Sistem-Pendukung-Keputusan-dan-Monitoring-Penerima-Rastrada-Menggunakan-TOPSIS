@extends('layouts.app')

@section('content')
    @php
        $role = auth()->user()?->role?->name;
        $isAdmin = $role === 'Admin';
        $isPetugas = $role === 'Petugas';
        $isLurah = $role === 'Lurah';
        $isRTRW = $role === 'RT/RW';
    @endphp

    {{-- ============================================================ --}}
    {{-- PAGE HEADING with period context --}}
    {{-- ============================================================ --}}
    <div class="page-heading">
        <div class="page-title">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        @if ($isAdmin)
                            Dashboard Admin
                        @elseif($isPetugas)
                            Dashboard Petugas
                        @elseif($isLurah)
                            Dashboard Lurah
                        @endif
                    </h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <section class="row">

            {{-- ======================================================== --}}
            {{-- LEFT CONTENT --}}
            {{-- ======================================================== --}}
            <div class="col-12 col-lg-9">

                {{-- ---------------------------------------------------- --}}
                {{-- ADMIN & PETUGAS --}}
                {{-- ---------------------------------------------------- --}}
                @if ($isAdmin || $isPetugas)

                    {{-- STAT CARDS --}}
                    <div class="row g-3 dashboard-stats">

                        {{-- Total Penduduk --}}
                        <div class="col-6 col-md-6 col-lg-3">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded-4" style="flex-shrink: 0">
                                        <i class="bi bi-people-fill text-primary fs-3"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small stat-label">Total Penduduk</div>
                                        <div class="fs-4 fw-bold">{{ $totalPenduduk }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Total Penerima --}}
                        <div class="col-6 col-md-6 col-lg-3">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="bg-info bg-opacity-10 p-3 rounded-4" style="flex-shrink: 0">
                                        <i class="bi bi-person-check-fill text-info fs-3"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small stat-label">Total Penerima</div>
                                        <div class="fs-4 fw-bold">{{ $totalPenerima }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Sudah Ambil --}}
                        <div class="col-6 col-md-6 col-lg-3">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="bg-success bg-opacity-10 p-3 rounded-4" style="flex-shrink: 0">
                                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small stat-label">Sudah Ambil</div>
                                        <div class="fs-4 fw-bold text-success">{{ $sudahAmbil }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Belum Ambil --}}
                        <div class="col-6 col-md-6 col-lg-3">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="bg-danger bg-opacity-10 p-3 rounded-4" style="flex-shrink: 0">
                                        <i class="bi bi-exclamation-triangle-fill text-danger fs-3"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small stat-label">Belum Ambil</div>
                                        <div class="fs-4 fw-bold text-danger">{{ $belumAmbil }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- PROGRESS DISTRIBUSI --}}
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header  border-0 pb-0">
                            <h5 class="mb-0">Progress Distribusi Bantuan</h5>
                            <small class="text-muted">
                                {{ $sudahAmbil }} dari {{ $totalPenerima }} penerima sudah mengambil bantuan
                            </small>
                        </div>
                        <div class="card-body pt-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="small text-muted">Realisasi</span>
                                <span
                                    class="small fw-bold
                                    {{ $realisasi >= 100 ? 'text-success' : ($realisasi >= 50 ? 'text-warning' : 'text-danger') }}">
                                    {{ number_format($realisasi, 1) }}%
                                </span>
                            </div>
                            <div class="progress rounded-pill" style="height: 16px;">
                                <div class="progress-bar
                                    {{ $realisasi >= 100 ? 'bg-success' : ($realisasi >= 50 ? 'bg-warning' : 'bg-danger') }}
                                    rounded-pill"
                                    role="progressbar" style="width: {{ $realisasi }}%"
                                    aria-valuenow="{{ $realisasi }}" aria-valuemin="0" aria-valuemax="100">
                                    @if ($realisasi >= 15)
                                        <span class="small px-2">{{ number_format($realisasi, 1) }}%</span>
                                    @endif
                                </div>
                            </div>
                            {{-- Milestone labels --}}
                            <div class="d-flex justify-content-between mt-1">
                                <small class="text-muted">0%</small>
                                <small class="text-muted">50%</small>
                                <small class="text-muted">100%</small>
                            </div>
                        </div>
                    </div>

                    {{-- TOP RANKING --}}
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header border-0 d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="mb-0">
                                    @if ($isAdmin)
                                        Top Ranking TOPSIS
                                    @else
                                        Prioritas Distribusi Bantuan
                                    @endif
                                </h5>
                                <small class="text-muted">5 penerima teratas periode ini</small>
                            </div>
                            <a href="/hasil" class="btn btn-sm btn-outline-primary">
                                Lihat Semua <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="card-body p-0">
                            @if ($topRanking->isEmpty())
                                <div class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <p class="mb-1">Belum ada data ranking.</p>
                                    @if ($isAdmin)
                                        <a href="/topsis" class="btn btn-sm btn-primary mt-1">
                                            Jalankan TOPSIS
                                        </a>
                                    @else
                                        <small>Hubungi admin untuk menjalankan perhitungan TOPSIS.</small>
                                    @endif
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-3">Rank</th>
                                                <th>Nama</th>
                                                <th>Nilai Vi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topRanking as $item)
                                                <tr>
                                                    <td class="ps-3">
                                                        <span
                                                            class="badge
                                                            {{ $item['rank'] == 1
                                                                ? 'bg-warning text-dark'
                                                                : ($item['rank'] == 2
                                                                    ? 'bg-secondary'
                                                                    : ($item['rank'] == 3
                                                                        ? 'bg-danger bg-opacity-75'
                                                                        : 'bg-light text-dark')) }}">
                                                            #{{ $item['rank'] }}
                                                        </span>
                                                    </td>
                                                    <td class="fw-semibold">{{ $item['nama'] }}</td>
                                                    <td>
                                                        <span class="font-monospace">
                                                            {{ number_format($item['nilai'], 3) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- ---------------------------------------------------- --}}
                    {{-- LURAH --}}
                    {{-- ---------------------------------------------------- --}}
                @elseif($isLurah)
                    {{-- STAT CARDS --}}
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded-4" style="flex-shrink: 0">
                                        <i class="bi bi-people-fill text-primary fs-3"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Total Penerima</div>
                                        <div class="fs-4 fw-bold">{{ $totalPenerima }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="bg-success bg-opacity-10 p-3 rounded-4" style="flex-shrink: 0">
                                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Sudah Ambil</div>
                                        <div class="fs-4 fw-bold text-success">{{ $sudahAmbil }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="bg-danger bg-opacity-10 p-3 rounded-4" style="flex-shrink: 0">
                                        <i class="bi bi-exclamation-circle-fill text-danger fs-3"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Belum Ambil</div>
                                        <div class="fs-4 fw-bold text-danger">{{ $belumAmbil }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PROGRESS --}}
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header border-0 pb-0">
                            <h5 class="mb-0">Monitoring Distribusi Bantuan</h5>
                            <small class="text-muted">
                                {{ $sudahAmbil }} dari {{ $totalPenerima }} penerima sudah mengambil bantuan
                            </small>
                        </div>
                        <div class="card-body pt-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="small text-muted">Realisasi</span>
                                <span
                                    class="small fw-bold
                                    {{ $realisasi >= 100 ? 'text-success' : ($realisasi >= 50 ? 'text-warning' : 'text-danger') }}">
                                    {{ number_format($realisasi, 1) }}%
                                </span>
                            </div>
                            <div class="progress rounded-pill" style="height: 16px;">
                                <div class="progress-bar
                                    {{ $realisasi >= 100 ? 'bg-success' : ($realisasi >= 50 ? 'bg-warning' : 'bg-danger') }}
                                    rounded-pill"
                                    role="progressbar" style="width: {{ $realisasi }}%"
                                    aria-valuenow="{{ $realisasi }}" aria-valuemin="0" aria-valuemax="100">
                                    @if ($realisasi >= 15)
                                        <span class="small px-2">{{ number_format($realisasi, 1) }}%</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <small class="text-muted">0%</small>
                                <small class="text-muted">50%</small>
                                <small class="text-muted">100%</small>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-12 col-xl-6">
                            {{-- TOP RANKING untuk Lurah --}}
                            <div class="card shadow-sm border-0 mt-3">
                                <div class="card-header  border-0 d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5 class="mb-0">Daftar Penerima Prioritas</h5>
                                        <small class="text-muted">5 penerima teratas berdasarkan perhitungan TOPSIS</small>
                                    </div>
                                    <a href="/hasil" class="btn btn-sm btn-outline-primary">
                                        Lihat Semua <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                                <div class="card-body p-0">
                                    @if ($topRanking->isEmpty())
                                        <div class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                            <p class="mb-0">Belum ada data rekomendasi untuk periode ini.</p>
                                        </div>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="ps-3">Rank</th>
                                                        <th>Nama</th>
                                                        <th>Nilai Vi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($topRanking as $item)
                                                        <tr>
                                                            <td class="ps-3">
                                                                <span
                                                                    class="badge
                                                            {{ $item['rank'] == 1
                                                                ? 'bg-warning text-dark'
                                                                : ($item['rank'] == 2
                                                                    ? 'bg-secondary'
                                                                    : ($item['rank'] == 3
                                                                        ? 'bg-danger bg-opacity-75'
                                                                        : 'bg-light text-dark')) }}">
                                                                    #{{ $item['rank'] }}
                                                                </span>
                                                            </td>
                                                            <td class="fw-semibold">{{ $item['nama'] }}</td>
                                                            <td>
                                                                <span class="font-monospace">
                                                                    {{ number_format($item['nilai'], 3) }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-6">

                            {{-- CARD GRAFIK --}}
                            <div class="card shadow-sm border-0 mt-3">

                                <div class="card-header border-0">
                                    <h5 class="mb-0">Penerima RASTRADA per RW</h5>
                                    <small class="text-muted">
                                        Statistik penerima pada periode aktif
                                    </small>
                                </div>

                                <div class="card-body">

                                    <div style="height:240px;">
                                        <canvas id="rwChart"></canvas>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                @elseif($isRTRW)
                    @php
                        $persenLakiLaki = $totalPenduduk > 0 ? ($totalLakiLaki / $totalPenduduk) * 100 : 0;
                        $persenPerempuan = $totalPenduduk > 0 ? ($totalPerempuan / $totalPenduduk) * 100 : 0;
                    @endphp

                    {{-- Statistik --}}
                    <div class="row g-3">

                        {{-- Total Penduduk --}}
                        <div class="col-6 col-md-6 col-lg-3">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded-4">
                                        <i class="bi bi-people-fill text-primary fs-3"></i>
                                    </div>

                                    <div>
                                        <div class="text-muted small">
                                            Total Penduduk
                                        </div>

                                        <div class="fs-4 fw-bold">
                                            {{ $totalPenduduk }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Laki-Laki --}}
                        <div class="col-6 col-md-6 col-lg-3">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="bg-success bg-opacity-10 p-3 rounded-4">
                                        <i class="bi bi-person-fill text-success fs-3"></i>
                                    </div>

                                    <div>
                                        <div class="text-muted small">
                                            Laki-Laki
                                        </div>

                                        <div class="fs-4 fw-bold text-success">
                                            {{ $totalLakiLaki }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Perempuan --}}
                        <div class="col-6 col-md-6 col-lg-3">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="bg-danger bg-opacity-10 p-3 rounded-4">
                                        <i class="bi bi-person-fill text-danger fs-3"></i>
                                    </div>

                                    <div>
                                        <div class="text-muted small">
                                            Perempuan
                                        </div>

                                        <div class="fs-4 fw-bold text-danger">
                                            {{ $totalPerempuan }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Wilayah --}}
                        <div class="col-6 col-md-6 col-lg-3">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="bg-warning bg-opacity-10 p-3 rounded-4">
                                        <i class="bi bi-geo-alt-fill text-warning fs-3"></i>
                                    </div>

                                    <div>
                                        <div class="text-muted small">
                                            Wilayah
                                        </div>

                                        <div class="fw-bold">
                                            RW {{ auth()->user()->rw }}
                                        </div>

                                        <div class="fw-bold">
                                            RT {{ auth()->user()->rt }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                    {{-- Komposisi Penduduk --}}
                    <div class="card shadow-sm border-0 mt-3">

                        <div class="card-header border-0 pb-0">
                            <h5 class="mb-0">
                                Komposisi Penduduk
                            </h5>

                            <small class="text-muted">
                                Perbandingan penduduk laki-laki dan perempuan
                            </small>
                        </div>

                        <div class="card-body">

                            <div class="mb-3">

                                <div class="d-flex justify-content-between mb-1">
                                    <span>Laki-Laki</span>
                                    <strong>{{ $totalLakiLaki }}</strong>
                                </div>

                                <div class="progress rounded-pill">
                                    <div class="progress-bar bg-success" style="width: {{ $persenLakiLaki }}%">
                                    </div>
                                </div>

                            </div>

                            <div>

                                <div class="d-flex justify-content-between mb-1">
                                    <span>Perempuan</span>
                                    <strong>{{ $totalPerempuan }}</strong>
                                </div>

                                <div class="progress rounded-pill">
                                    <div class="progress-bar bg-danger" style="width: {{ $persenPerempuan }}%">
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Informasi --}}
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-body">
                            <h5>
                                <i class="bi bi-info-circle-fill text-info me-2"></i>
                                Informasi
                            </h5>

                            <p class="mb-0">
                                Kelola data penduduk wilayah
                                <strong>RT {{ auth()->user()->rt }}</strong>
                                dan
                                <strong>RW {{ auth()->user()->rw }}</strong>
                                melalui menu
                                <strong>Data Penduduk</strong>.
                            </p>
                        </div>
                    </div>

                @endif
            </div>

            {{-- ======================================================== --}}
            {{-- RIGHT SIDEBAR --}}
            {{-- ======================================================== --}}
            <div class="col-12 col-lg-3">

                {{-- PROFILE CARD --}}
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="{{ asset('assets/compiled/jpg/1.jpg') }}" alt="User">
                            </div>
                            <div class="ms-3">
                                <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
                                <span
                                    class="badge
                                    @if ($isAdmin) bg-primary
                                    @elseif($isPetugas) bg-success
                                    @elseif($isLurah) bg-warning text-dark
                                    @elseif($isRTRW) bg-info @endif">
                                    {{ auth()->user()?->role?->name ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @if (!$isRTRW)
                    {{-- STATUS DISTRIBUSI --}}
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header border-0">
                            <h6 class="mb-0">
                                <i class="bi bi-bar-chart-fill me-1 text-success"></i>
                                Status Distribusi
                            </h6>
                        </div>

                        <div class="card-body pt-0">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small">Sudah Ambil</span>
                                <span class="fw-bold text-success">{{ $sudahAmbil }}</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="small">Belum Ambil</span>
                                <span class="fw-bold text-danger">{{ $belumAmbil }}</span>
                            </div>

                            <div class="progress rounded-pill" style="height:8px">
                                <div class="progress-bar bg-success rounded-pill" style="width: {{ $realisasi }}%">
                                </div>
                            </div>

                            <div class="text-end mt-1">
                                <small class="text-muted">
                                    {{ number_format($realisasi, 1) }}% selesai
                                </small>
                            </div>

                        </div>
                    </div>
                @else
                    {{-- INFO WILAYAH RT/RW --}}
                    <div class="card shadow-sm border-0 mb-3">

                        <div class="card-header border-0">
                            <h6 class="mb-0">
                                <i class="bi bi-geo-alt-fill me-1 text-primary"></i>
                                Wilayah Tugas
                            </h6>
                        </div>

                        <div class="card-body pt-0">

                            <div class="d-flex justify-content-between mb-2">
                                <span>RW</span>
                                <strong>{{ auth()->user()->rw }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>RT</span>
                                <strong>{{ auth()->user()->rt }}</strong>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <span>Total Penduduk</span>
                                <strong class="text-primary">
                                    {{ $totalPenduduk }}
                                </strong>
                            </div>

                        </div>

                    </div>
                @endif

                {{-- SHORTCUT AKSI — sesuai role --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header border-0">
                        <h6 class="mb-0"><i class="bi bi-lightning-fill me-1 text-warning"></i> Aksi Cepat</h6>
                    </div>
                    <div class="card-body pt-0 d-grid gap-2">
                        @if ($isAdmin)
                            <a href="/resident" class="btn btn-sm btn-outline-primary text-start">
                                <i class="bi bi-people me-1"></i> Data Penduduk
                            </a>
                            <a href="/topsis" class="btn btn-sm btn-outline-warning text-start">
                                <i class="bi bi-calculator me-1"></i> Jalankan TOPSIS
                            </a>
                            <a href="/report" class="btn btn-sm btn-outline-secondary text-start">
                                <i class="bi bi-file-earmark-text me-1"></i> Cetak Laporan
                            </a>
                        @elseif($isPetugas)
                            <a href="/resident" class="btn btn-sm btn-outline-primary text-start">
                                <i class="bi bi-people me-1"></i> Data Penduduk
                            </a>
                            <a href="/penilaian" class="btn btn-sm btn-outline-success text-start">
                                <i class="bi bi-pencil-square me-1"></i> Input Penilaian
                            </a>
                            <a href="/monitoring" class="btn btn-sm btn-outline-info text-start">
                                <i class="bi bi-activity me-1"></i> Monitoring Pengambilan
                            </a>
                            <a href="/report" class="btn btn-sm btn-outline-secondary text-start">
                                <i class="bi bi-file-earmark-text me-1"></i> Cetak Laporan
                            </a>
                        @elseif($isLurah)
                            <a href="/hasil" class="btn btn-sm btn-outline-primary text-start">
                                <i class="bi bi-clipboard2-check me-1"></i> Hasil Rekomendasi
                            </a>
                            <a href="/monitoring" class="btn btn-sm btn-outline-info text-start">
                                <i class="bi bi-activity me-1"></i> Monitoring
                            </a>
                            <a href="/report" class="btn btn-sm btn-outline-secondary text-start">
                                <i class="bi bi-file-earmark-text me-1"></i> Cetak Laporan
                            </a>
                        @elseif($isRTRW)
                            <a href="/resident" class="btn btn-sm btn-outline-primary text-start">
                                <i class="bi bi-people me-1"></i>
                                Data Penduduk
                            </a>

                            <a href="/resident/create" class="btn btn-sm btn-outline-success text-start">
                                <i class="bi bi-plus-circle me-1"></i>
                                Tambah Penduduk
                            </a>

                            <a href="/profile" class="btn btn-sm btn-outline-secondary text-start">
                                <i class="bi bi-person-circle me-1"></i>
                                Profil Saya
                            </a>
                        @endif
                    </div>
                </div>

            </div>
            {{-- end right sidebar --}}

        </section>
    </div>

    @if ($isLurah)
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const rwLabels = @json($rwLabels);
                const rwTotals = @json($rwTotals);

                const ctx = document.getElementById('rwChart');

                if (!ctx) return;

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: rwLabels,
                        datasets: [{
                            label: 'Jumlah Penerima',
                            data: rwTotals
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,

                        plugins: {
                            legend: {
                                display: true
                            }
                        },

                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });

            });
        </script>
    @endif
@endsection
