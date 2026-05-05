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
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Monitoring</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">

        {{-- Summary Cards --}}
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body px-3 py-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-light-primary me-3">
                                <i class="bi bi-people fs-4 text-primary"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted" style="font-size:12px">Total Penerima</p>
                                <h5 class="mb-0 fw-bold">8</h5>
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
                                <p class="mb-0 text-muted" style="font-size:12px">Sudah Ambil</p>
                                <h5 class="mb-0 fw-bold text-success">5</h5>
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
                                <i class="bi bi-hourglass-split fs-4 text-warning"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted" style="font-size:12px">Belum Ambil</p>
                                <h5 class="mb-0 fw-bold text-warning">3</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body px-3 py-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-light-info me-3">
                                <i class="bi bi-graph-up fs-4 text-info"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted" style="font-size:12px">Realisasi</p>
                                <h5 class="mb-0 fw-bold text-info">62.5%</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Progress Realisasi --}}
        <div class="card mb-4">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between mb-1">
                    <small class="fw-bold">Progress Penyaluran Periode 2025</small>
                    <small class="text-muted">5 dari 8 penerima</small>
                </div>
                <div class="progress" style="height:10px; border-radius:10px">
                    <div class="progress-bar bg-success" style="width:62.5%"></div>
                </div>
            </div>
        </div>

        {{-- Filter --}}
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-md-3">
                        <label class="form-label mb-1" style="font-size:13px">Filter Status</label>
                        <select class="form-select form-select-sm">
                            <option value="">Semua Status</option>
                            <option value="sudah">Sudah Ambil</option>
                            <option value="belum">Belum Ambil</option>
                        </select>
                    </div>
                    {{-- <div class="col-12 col-md-3">
                        <label class="form-label mb-1" style="font-size:13px">Filter Desa</label>
                        <select class="form-select form-select-sm">
                            <option value="">Semua Desa</option>
                            <option value="sukamaju">Sukamaju</option>
                            <option value="cimaung">Cimaung</option>
                            <option value="margaasih">Margaasih</option>
                        </select>
                    </div> --}}
                    <div class="col-12 col-md-3">
                        <label class="form-label mb-1" style="font-size:13px">Periode</label>
                        <select class="form-select form-select-sm">
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>
                    {{-- <div class="col-12 col-md-3">
                        <button class="btn btn-sm btn-primary w-100">
                            <i class="bi bi-search"></i> Filter
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>

        {{-- Tabel Monitoring --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Penerima</h5>
                {{-- <a href="#" class="btn btn-sm btn-success">
                    <i class="bi bi-download"></i> Export
                </a> --}}
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive" id="table1">
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

                        {{-- Sudah ambil --}}
                        <tr>
                            <td>1</td>
                            <td class="fw-bold">Nurjanah</td>
                            <td>3204010101010001</td>
                            <td><span class="badge bg-warning text-dark">#1</span></td>
                            <td><span class="badge bg-success">Sudah Ambil</span></td>
                            <td>
                                <span style="font-size:13px">12 Jan 2025</span><br>
                                <small class="text-muted">09:24 WIB</small>
                            </td>
                            <td>Sendiri</td>
                            <td>
                                <small>Admin</small>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td class="fw-bold">Siti Rahmawati</td>
                            <td>3204010101010002</td>
                            <td><span class="badge bg-secondary">#2</span></td>
                            <td><span class="badge bg-success">Sudah Ambil</span></td>
                            <td>
                                <span style="font-size:13px">12 Jan 2025</span><br>
                                <small class="text-muted">10:05 WIB</small>
                            </td>
                            <td>Diwakilkan</td>
                            <td>
                                <small>Admin</small>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td class="fw-bold">Ahmad Fauzi</td>
                            <td>3204010101010003</td>
                            <td><span class="badge" style="background:#cd7f32">#3</span></td>
                            <td><span class="badge bg-success">Sudah Ambil</span></td>
                            <td>
                                <span style="font-size:13px">13 Jan 2025</span><br>
                                <small class="text-muted">08:47 WIB</small>
                            </td>
                            <td>Sendiri</td>
                            <td>
                                <small>Admin</small>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>

                        {{-- Belum ambil --}}
                        <tr>
                            <td>4</td>
                            <td>Budi Santoso</td>
                            <td>3204010101010004</td>
                            <td><span class="badge bg-light text-dark border">#4</span></td>
                            <td><span class="badge bg-warning text-dark">Belum Ambil</span></td>
                            <td><small class="text-muted">-</small></td>
                            <td><small class="text-muted">-</small></td>
                            <td><small class="text-muted">-</small></td>
                            <td>
                                <a href="/distribusi/catat/4" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i> Catat
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>Dewi Lestari</td>
                            <td>3204010101010005</td>
                            <td><span class="badge bg-light text-dark border">#5</span></td>
                            <td><span class="badge bg-warning text-dark">Belum Ambil</span></td>
                            <td><small class="text-muted">-</small></td>
                            <td><small class="text-muted">-</small></td>
                            <td><small class="text-muted">-</small></td>
                            <td>
                                <a href="/distribusi/catat/5" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i> Catat
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td>Hendra Kurniawan</td>
                            <td>3204010101010006</td>
                            <td><span class="badge bg-light text-dark border">#6</span></td>
                            <td><span class="badge bg-warning text-dark">Belum Ambil</span></td>
                            <td><small class="text-muted">-</small></td>
                            <td><small class="text-muted">-</small></td>
                            <td><small class="text-muted">-</small></td>
                            <td>
                                <a href="/distribusi/catat/6" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i> Catat
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
