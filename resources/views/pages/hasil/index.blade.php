@extends('layouts.app')

@section('content')
    <div class="page-heading">

        <div class="page-title">
            <div class="row">

                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Hasil Rekomendasi</h3>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>

                            <li class="breadcrumb-item active">
                                Hasil Rekomendasi
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        <section class="section">

            <!-- SUMMARY -->
            <div class="row">

                <!-- Total -->
                <div class="col-6 col-md-3">
                    <div class="card">

                        <div class="card-body px-3 py-3">

                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-md bg-light-primary me-3">
                                    <i class="bi bi-people fs-4 text-primary"></i>
                                </div>

                                <div>
                                    <p class="mb-0 text-muted" style="font-size:12px">
                                        Total Penduduk
                                    </p>

                                    <h5 class="mb-0 fw-bold">
                                        {{ $totalPenduduk }}
                                    </h5>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Direkomendasikan -->
                <div class="col-6 col-md-3">
                    <div class="card">

                        <div class="card-body px-3 py-3">

                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-md bg-light-success me-3">
                                    <i class="bi bi-check-circle fs-4 text-success"></i>
                                </div>

                                <div>
                                    <p class="mb-0 text-muted" style="font-size:12px">
                                        Direkomendasikan
                                    </p>

                                    <h5 class="mb-0 fw-bold text-success">
                                        {{ $direkomendasikan }}
                                    </h5>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Tidak Direkomendasikan -->
                <div class="col-6 col-md-3">
                    <div class="card">

                        <div class="card-body px-3 py-3">

                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-md bg-light-danger me-3">
                                    <i class="bi bi-x-circle fs-4 text-danger"></i>
                                </div>

                                <div>
                                    <p class="mb-0 text-muted" style="font-size:12px">
                                        Tidak Direkomendasikan
                                    </p>

                                    <h5 class="mb-0 fw-bold text-danger">
                                        {{ $tidakDirekomendasikan }}
                                    </h5>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Periode -->
                <div class="col-6 col-md-3">

                    <div class="card">

                        <div class="card-body px-3 py-3">

                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-md bg-light-warning me-4">
                                    <i class="bi bi-calendar fs-3 text-warning"></i>
                                </div>

                                <div class="w-100">

                                    <p class="mb-1 text-muted" style="font-size:12px">

                                        Periode
                                    </p>

                                    <form method="GET">

                                        <select name="periode_id" class="form-select form-select-sm"
                                            onchange="this.form.submit()">

                                            @foreach ($periodeList as $p)
                                                <option value="{{ $p->id }}"
                                                    {{ $periode_id == $p->id ? 'selected' : '' }}>

                                                    {{ $p->nama_periode }}

                                                </option>
                                            @endforeach

                                        </select>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- TABEL -->
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h5 class="card-title mb-0">
                        Ranking Hasil TOPSIS
                    </h5>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped" id="table1">

                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Nilai Preferensi (Vi)</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($hasil as $row)
                                    <tr>

                                        <!-- RANK -->
                                        <td>

                                            @if ($row['rank'] == 1)
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-trophy-fill"></i>
                                                    {{ $row['rank'] }}
                                                </span>
                                            @elseif ($row['rank'] == 2)
                                                <span class="badge bg-secondary">
                                                    <i class="bi bi-award-fill"></i>
                                                    {{ $row['rank'] }}
                                                </span>
                                            @elseif ($row['rank'] == 3)
                                                <span class="badge" style="background:#cd7f32">
                                                    <i class="bi bi-award-fill"></i>
                                                    {{ $row['rank'] }}
                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark border">
                                                    {{ $row['rank'] }}
                                                </span>
                                            @endif

                                        </td>

                                        <!-- NAMA -->
                                        <td class="fw-bold">
                                            {{ $row['nama'] }}
                                        </td>

                                        <!-- NIK -->
                                        <td>
                                            {{ $row['nik'] }}
                                        </td>

                                        <!-- NILAI -->
                                        <td>

                                            <div class="d-flex align-items-center gap-2">

                                                <div class="progress w-100" style="height:6px">

                                                    <div class="progress-bar
                                                    {{ $row['nilai'] >= 0.7 ? 'bg-success' : 'bg-danger' }}"
                                                        style="width: {{ $row['nilai'] * 100 }}%">
                                                    </div>

                                                </div>

                                                <small class="text-muted" style="min-width:50px">

                                                    {{ number_format($row['nilai'], 3) }}

                                                </small>

                                            </div>

                                        </td>

                                        <!-- STATUS -->
                                        <td>

                                            @if ($row['status'] == 'Direkomendasikan')
                                                <span class="badge bg-success">
                                                    {{ $row['status'] }}
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    {{ $row['status'] }}
                                                </span>
                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center">
                                            Tidak ada data hasil
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <!-- KETERANGAN -->
                    <div class="d-flex gap-3 mt-3" style="font-size:12px">

                        <span>
                            <span class="badge bg-success me-1">
                                ✓
                            </span>

                            Direkomendasikan jika Vi ≥ 0.70
                        </span>

                        <span>
                            <span class="badge bg-danger me-1">
                                ✗
                            </span>

                            Tidak Direkomendasikan jika Vi &lt; 0.70
                        </span>

                    </div>

                </div>

            </div>

        </section>

    </div>
@endsection
