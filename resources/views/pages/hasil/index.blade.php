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
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Hasil Rekomendasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">

        {{-- Summary Cards --}}
        <div class="row mb-4">
            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body px-3 py-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-light-primary me-3">
                                <i class="bi bi-people fs-4 text-primary"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted" style="font-size:12px">Total Penduduk</p>
                                <h5 class="mb-0 fw-bold">24</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body px-3 py-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-light-success me-3">
                                <i class="bi bi-check-circle fs-4 text-success"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted" style="font-size:12px">Direkomendasikan</p>
                                <h5 class="mb-0 fw-bold text-success">8</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body px-3 py-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-light-danger me-3">
                                <i class="bi bi-x-circle fs-4 text-danger"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted" style="font-size:12px">Tidak Direkomendasikan</p>
                                <h5 class="mb-0 fw-bold text-danger">16</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body px-3 py-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-light-warning me-3">
                                <i class="bi bi-calendar fs-4 text-warning"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted" style="font-size:12px">Periode</p>
                                <h5 class="mb-0 fw-bold">2026</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Hasil --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Ranking Hasil TOPSIS</h5>
                {{-- <a href="#" class="btn btn-sm btn-success shadow-sm">
                    <i class="bi bi-download"></i> Export Excel
                </a> --}}
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive" id="table1">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Nilai Preferensi (Vi)</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Rank 1 --}}
                        <tr>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-trophy-fill"></i> 1
                                </span>
                            </td>
                            <td class="fw-bold">Nurjanah</td>
                            <td>3204010101010001</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height:6px">
                                        <div class="progress-bar bg-success" style="width:92%"></div>
                                    </div>
                                    <small class="text-muted" style="min-width:38px">0.921</small>
                                </div>
                            </td>
                            <td><span class="badge bg-success">Direkomendasikan</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary text-white">
                                    <i class="bi bi-eye"></i> 
                                </a>
                            </td>
                        </tr>

                        {{-- Rank 2 --}}
                        <tr>
                            <td>
                                <span class="badge bg-secondary">
                                    <i class="bi bi-award-fill"></i> 2
                                </span>
                            </td>
                            <td>Siti Rahmawati</td>
                            <td>3204010101010002</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height:6px">
                                        <div class="progress-bar bg-success" style="width:84%"></div>
                                    </div>
                                    <small class="text-muted" style="min-width:38px">0.843</small>
                                </div>
                            </td>
                            <td><span class="badge bg-success">Direkomendasikan</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary text-white">
                                    <i class="bi bi-eye"></i> 
                                </a>
                            </td>
                        </tr>

                        {{-- Rank 3 --}}
                        <tr>
                            <td>
                                <span class="badge" style="background:#cd7f32">
                                    <i class="bi bi-award-fill"></i> 3
                                </span>
                            </td>
                            <td>Ahmad Fauzi</td>
                            <td>3204010101010003</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height:6px">
                                        <div class="progress-bar bg-success" style="width:77%"></div>
                                    </div>
                                    <small class="text-muted" style="min-width:38px">0.771</small>
                                </div>
                            </td>
                            <td><span class="badge bg-success">Direkomendasikan</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary text-white">
                                    <i class="bi bi-eye"></i> 
                                </a>
                            </td>
                        </tr>

                        {{-- Rank 4 --}}
                        <tr>
                            <td><span class="badge bg-light text-dark border">4</span></td>
                            <td>Budi Santoso</td>
                            <td>3204010101010004</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height:6px">
                                        <div class="progress-bar bg-success" style="width:61%"></div>
                                    </div>
                                    <small class="text-muted" style="min-width:38px">0.612</small>
                                </div>
                            </td>
                            <td><span class="badge bg-success">Direkomendasikan</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary text-white">
                                    <i class="bi bi-eye"></i> 
                                </a>
                            </td>
                        </tr>

                        {{-- Rank 5 --}}
                        <tr>
                            <td><span class="badge bg-light text-dark border">5</span></td>
                            <td>Dewi Lestari</td>
                            <td>3204010101010005</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height:6px">
                                        <div class="progress-bar bg-danger" style="width:43%"></div>
                                    </div>
                                    <small class="text-muted" style="min-width:38px">0.432</small>
                                </div>
                            </td>
                            <td><span class="badge bg-danger">Tidak</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary text-white">
                                    <i class="bi bi-eye"></i> 
                                </a>
                            </td>
                        </tr>

                        {{-- Rank 6 --}}
                        <tr>
                            <td><span class="badge bg-light text-dark border">6</span></td>
                            <td>Hendra Kurniawan</td>
                            <td>3204010101010006</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height:6px">
                                        <div class="progress-bar bg-danger" style="width:31%"></div>
                                    </div>
                                    <small class="text-muted" style="min-width:38px">0.314</small>
                                </div>
                            </td>
                            <td><span class="badge bg-danger">Tidak</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary text-white">
                                    <i class="bi bi-eye"></i> 
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>

                {{-- Keterangan --}}
                <div class="d-flex gap-3 mt-3" style="font-size:12px">
                    <span><span class="badge bg-success me-1">&#x2713;</span> Direkomendasikan jika Vi &ge; 0.5</span>
                    <span><span class="badge bg-danger me-1">&#x2717;</span> Tidak direkomendasikan jika Vi &lt; 0.5</span>
                </div>

            </div>
        </div>

    </section>
</div>
@endsection
