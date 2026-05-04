@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laporan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">

        {{-- Filter --}}
        <div class="card mb-4">
            <div class="card-body py-3">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-md-3">
                        <label class="form-label mb-1" style="font-size:13px">Periode / Tahun</label>
                        <select class="form-select form-select-sm">
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>
                    {{-- <div class="col-12 col-md-3">
                        <label class="form-label mb-1" style="font-size:13px">Desa</label>
                        <select class="form-select form-select-sm">
                            <option value="">Semua Desa</option>
                            <option value="sukamaju">Sukamaju</option>
                            <option value="cimaung">Cimaung</option>
                            <option value="margaasih">Margaasih</option>
                        </select>
                    </div> --}}
                    <div class="col-12 col-md-2">
                        <button class="btn btn-sm btn-primary w-100">
                            <i class="bi bi-search"></i> Tampilkan
                        </button>
                    </div>
                    <div class="col-12 col-md-3">
                    </div>
                    <div class="col-12 col-md-4 d-flex gap-2 justify-content-md-end">
                        <a href="/laporan/export-pdf?periode=2025" class="btn btn-sm btn-danger" target="_blank">
                            <i class="bi bi-file-earmark-pdf"></i> Export PDF
                        </a>
                        <a href="/laporan/export-excel?periode=2025" class="btn btn-sm btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Summary Cards --}}
        {{-- <div class="row mb-4">
            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body px-3 py-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-light-primary me-3">
                                <i class="bi bi-people fs-4 text-primary"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted" style="font-size:12px">Total Didata</p>
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
                                <i class="bi bi-patch-check fs-4 text-success"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted" style="font-size:12px">Layak Menerima</p>
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
                            <div class="avatar avatar-md bg-light-warning me-3">
                                <i class="bi bi-hourglass-split fs-4 text-warning"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted" style="font-size:12px">Sudah Ambil</p>
                                <h5 class="mb-0 fw-bold text-warning">5</h5>
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
        </div> --}}

        {{-- card statistik --}}
            {{-- <div class="row mb-4"> --}}
                {{-- Grafik Status Distribusi --}}
                {{-- <div class="col-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Status Distribusi</h5>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <canvas id="chartStatus" style="max-height:220px"></canvas>
                        </div>
                    </div>
                </div> --}}

                {{-- Grafik Rekap Per Desa --}}
                {{-- <div class="col-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Rekap Per Desa</h5>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <canvas id="chartDesa" style="max-height:220px"></canvas>
                        </div>
                    </div>
                </div> --}}
            {{-- </div> --}}

        {{-- Tabel Detail --}}
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Penerima Bantuan Periode 2025</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Rank</th>
                            <th>Nilai Vi</th>
                            <th>Status Ambil</th>
                            <th>Tanggal Ambil</th>
                            <th>Diambil Oleh</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td class="fw-bold">Nurjanah</td>
                            <td>3204010101010001</td>
                            <td><span class="badge bg-warning text-dark">#1</span></td>
                            <td>0.921</td>
                            <td><span class="badge bg-success">Sudah Ambil</span></td>
                            <td>12 Jan 2025, 09:24</td>
                            <td>Sendiri</td>
                            <td>Admin</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="fw-bold">Siti Rahmawati</td>
                            <td>3204010101010002</td>
                            <td><span class="badge bg-secondary">#2</span></td>
                            <td>0.843</td>
                            <td><span class="badge bg-success">Sudah Ambil</span></td>
                            <td>12 Jan 2025, 10:05</td>
                            <td>Diwakilkan</td>
                            <td>Admin</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="fw-bold">Ahmad Fauzi</td>
                            <td>3204010101010003</td>
                            <td><span class="badge" style="background:#cd7f32">#3</span></td>
                            <td>0.771</td>
                            <td><span class="badge bg-success">Sudah Ambil</span></td>
                            <td>13 Jan 2025, 08:47</td>
                            <td>Sendiri</td>
                            <td>Admin</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Budi Santoso</td>
                            <td>3204010101010004</td>
                            <td><span class="badge bg-light text-dark border">#4</span></td>
                            <td>0.612</td>
                            <td><span class="badge bg-success">Sudah Ambil</span></td>
                            <td>13 Jan 2025, 11:30</td>
                            <td>Sendiri</td>
                            <td>Admin</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Rini Susanti</td>
                            <td>3204010101010005</td>
                            <td><span class="badge bg-light text-dark border">#5</span></td>
                            <td>0.589</td>
                            <td><span class="badge bg-success">Sudah Ambil</span></td>
                            <td>14 Jan 2025, 09:10</td>
                            <td>Diwakilkan</td>
                            <td>Admin</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Dewi Lestari</td>
                            <td>3204010101010006</td>
                            <td><span class="badge bg-light text-dark border">#6</span></td>
                            <td>0.541</td>
                            <td><span class="badge bg-warning text-dark">Belum Ambil</span></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Hendra Kurniawan</td>
                            <td>3204010101010007</td>
                            <td><span class="badge bg-light text-dark border">#7</span></td>
                            <td>0.520</td>
                            <td><span class="badge bg-warning text-dark">Belum Ambil</span></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Rina Marlina</td>
                            <td>3204010101010008</td>
                            <td><span class="badge bg-light text-dark border">#8</span></td>
                            <td>0.503</td>
                            <td><span class="badge bg-warning text-dark">Belum Ambil</span></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Pie - Status Distribusi
    const ctxStatus = document.getElementById('chartStatus').getContext('2d');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: ['Sudah Ambil', 'Belum Ambil'],
            datasets: [{
                data: [5, 3],
                backgroundColor: ['#28a745', '#ffc107'],
                borderWidth: 0
            }]
        },
        options: {
            plugins: {
                legend: { position: 'bottom' }
            },
            cutout: '65%'
        }
    });

    // Grafik Bar - Rekap Per Desa
    const ctxDesa = document.getElementById('chartDesa').getContext('2d');
    new Chart(ctxDesa, {
        type: 'bar',
        data: {
            labels: ['Sukamaju', 'Cimaung', 'Margaasih'],
            datasets: [
                {
                    label: 'Sudah Ambil',
                    data: [2, 2, 1],
                    backgroundColor: '#28a745',
                    borderRadius: 4
                },
                {
                    label: 'Belum Ambil',
                    data: [1, 1, 1],
                    backgroundColor: '#ffc107',
                    borderRadius: 4
                }
            ]
        },
        options: {
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                x: { grid: { display: false } },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: '#f0f0f0' }
                }
            }
        }
    });
</script>
@endsection
