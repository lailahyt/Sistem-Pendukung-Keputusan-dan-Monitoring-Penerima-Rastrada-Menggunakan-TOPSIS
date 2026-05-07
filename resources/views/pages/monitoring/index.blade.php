@extends('layouts.app')

@section('content')
    <div class="page-heading">

        <div class="page-title">
            <div class="row">

                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Monitoring Distribusi</h3>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">

                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>

                            <li class="breadcrumb-item active">
                                Monitoring
                            </li>
                        </ol>

                    </nav>
                </div>

            </div>
        </div>

        <section class="section">

            {{-- SUMMARY --}}
            <div class="row">

                {{-- Total --}}
                <div class="col-6 col-md-3">

                    <div class="card">

                        <div class="card-body px-3 py-3">

                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-md bg-light-primary me-3">
                                    <i class="bi bi-people fs-4 text-primary"></i>
                                </div>

                                <div>
                                    <p class="mb-0 text-muted" style="font-size:12px">

                                        Total Penerima
                                    </p>

                                    <h5 class="mb-0 fw-bold">
                                        {{ $totalPenerima }}
                                    </h5>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Sudah Ambil --}}
                <div class="col-6 col-md-3">

                    <div class="card">

                        <div class="card-body px-3 py-3">

                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-md bg-light-success me-3">
                                    <i class="bi bi-check-circle fs-4 text-success"></i>
                                </div>

                                <div>
                                    <p class="mb-0 text-muted" style="font-size:12px">

                                        Sudah Ambil
                                    </p>

                                    <h5 class="mb-0 fw-bold text-success">
                                        {{ $sudahAmbil }}
                                    </h5>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Belum Ambil --}}
                <div class="col-6 col-md-3">

                    <div class="card">

                        <div class="card-body px-3 py-3">

                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-md bg-light-warning me-3">
                                    <i class="bi bi-hourglass-split fs-4 text-warning"></i>
                                </div>

                                <div>
                                    <p class="mb-0 text-muted" style="font-size:12px">

                                        Belum Ambil
                                    </p>

                                    <h5 class="mb-0 fw-bold text-warning">
                                        {{ $belumAmbil }}
                                    </h5>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Realisasi --}}
                <div class="col-6 col-md-3">

                    <div class="card">

                        <div class="card-body px-3 py-3">

                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-md bg-light-info me-3">
                                    <i class="bi bi-graph-up fs-4 text-info"></i>
                                </div>

                                <div>
                                    <p class="mb-0 text-muted" style="font-size:12px">

                                        Realisasi
                                    </p>

                                    <h5 class="mb-0 fw-bold text-info">
                                        {{ number_format($realisasi, 1) }}%
                                    </h5>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- PROGRESS --}}
            <div class="card mb-4">

                <div class="card-body py-3">

                    <div class="d-flex justify-content-between mb-1">

                        <small class="fw-bold">
                            Progress Penyaluran
                            {{ $periode->nama_periode }}
                        </small>

                        <small class="text-muted">
                            {{ $sudahAmbil }}
                            dari
                            {{ $totalPenerima }}
                            penerima
                        </small>

                    </div>

                    <div class="progress" style="height:10px; border-radius:10px">

                        <div class="progress-bar bg-success" style="width: {{ $realisasi }}%">

                        </div>

                    </div>

                </div>

            </div>

            {{-- FILTER --}}
            <div class="card mb-3">

                <div class="card-body py-3">

                    <form method="GET">

                        <div class="row g-2 align-items-end">

                            {{-- FILTER STATUS --}}
                            <div class="col-12 col-md-3">

                                <label class="form-label mb-1" style="font-size:13px">

                                    Filter Status
                                </label>

                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">

                                    <option value="">
                                        Semua Status
                                    </option>

                                    <option value="sudah_ambil" {{ $status == 'sudah_ambil' ? 'selected' : '' }}>

                                        Sudah Ambil

                                    </option>

                                    <option value="belum_ambil" {{ $status == 'belum_ambil' ? 'selected' : '' }}>

                                        Belum Ambil

                                    </option>

                                </select>

                            </div>

                            {{-- FILTER PERIODE --}}
                            <div class="col-12 col-md-3">

                                <label class="form-label mb-1" style="font-size:13px">

                                    Periode
                                </label>

                                <select name="periode_id" class="form-select form-select-sm" onchange="this.form.submit()">

                                    @foreach ($periodeList as $p)
                                        <option value="{{ $p->id }}" {{ $periode_id == $p->id ? 'selected' : '' }}>

                                            {{ $p->nama_periode }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            {{-- TABEL --}}
            <div class="card">

                <div class="card-header">

                    <h5 class="card-title mb-0">
                        Daftar Penerima
                    </h5>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped" id="table1">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Rank</th>
                                    <th>Status</th>
                                    <th>Tanggal Ambil</th>
                                    <th>Diambil Oleh</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($monitoring as $item)
                                    <tr>

                                        {{-- NO --}}
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>

                                        {{-- NAMA --}}
                                        <td class="fw-bold">
                                            {{ $item->resident->nama }}
                                        </td>

                                        {{-- NIK --}}
                                        <td>
                                            {{ $item->resident->nik }}
                                        </td>

                                        {{-- RANK --}}
                                        <td>

                                            @if ($item->rank == 1)
                                                <span class="badge bg-warning text-dark">
                                                    #1
                                                </span>
                                            @elseif ($item->rank == 2)
                                                <span class="badge bg-secondary">
                                                    #2
                                                </span>
                                            @elseif ($item->rank == 3)
                                                <span class="badge" style="background:#cd7f32">

                                                    #3

                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark border">
                                                    #{{ $item->rank }}
                                                </span>
                                            @endif

                                        </td>

                                        {{-- STATUS --}}
                                        <td>

                                            @if ($item->status_pengambilan == 'sudah_ambil')
                                                <span class="badge bg-success">
                                                    Sudah Ambil
                                                </span>
                                            @elseif ($item->status_pengambilan == 'ditunda')
                                                <span class="badge bg-danger">
                                                    Ditunda
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark">
                                                    Belum Ambil
                                                </span>
                                            @endif

                                        </td>

                                        {{-- TANGGAL --}}
                                        <td>

                                            @if ($item->tanggal_ambil)
                                                <span style="font-size:13px">

                                                    {{ \Carbon\Carbon::parse($item->tanggal_ambil)->format('d M Y') }}

                                                </span>

                                                <br>

                                                <small class="text-muted">

                                                    {{ \Carbon\Carbon::parse($item->tanggal_ambil)->format('H:i') }} WIB

                                                </small>
                                            @else
                                                <small class="text-muted">
                                                    -
                                                </small>
                                            @endif

                                        </td>

                                        {{-- DIAMBIL OLEH --}}
                                        <td>

                                            {{ $item->diambil_oleh ?? '-' }}

                                        </td>

                                        {{-- PETUGAS --}}
                                        <td>

                                            {{ $item->petugas ?? '-' }}

                                        </td>

                                        {{-- AKSI --}}
                                        <td>

                                            @php
                                                $isLurah = auth()->user()?->role?->name === 'Lurah';
                                            @endphp

                                            {{-- ROLE LURAH --}}
                                            @if ($isLurah)
                                                <a href="/monitoring/{{ $item->id }}" class="btn btn-info btn-sm">

                                                    <i class="bi bi-eye"></i>

                                                </a>
                                            @else
                                                {{-- SUDAH AMBIL --}}
                                                @if ($item->status_pengambilan == 'sudah_ambil')
                                                    <a href="/monitoring/{{ $item->id }}"
                                                        class="btn btn-info btn-sm">

                                                        <i class="bi bi-eye"></i>

                                                    </a>
                                                @else
                                                    {{-- ADMIN / PETUGAS --}}
                                                    <a href="/monitoring/{{ $item->id }}/create"
                                                        class="btn btn-primary btn-sm">

                                                        <i class="bi bi-pencil-square"></i>

                                                        Catat

                                                    </a>
                                                @endif
                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="9" class="text-center">

                                            Tidak ada data monitoring

                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </section>

    </div>
@endsection
