@extends('layouts.app')
@section('content')
    <div class="page-heading">

        <!-- HEADER -->
        <div class="page-title mb-4">

            <!-- BARIS 1: Judul + Breadcrumb -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3>Data Penilaian</h3>
                </div>

                <div class="col-md-6 text-md-end">
                    <nav aria-label="breadcrumb" class="breadcrumb-header">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Proses</li>
                            <li class="breadcrumb-item active">Penilaian</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- BARIS 2: FILTER (Dropdown) -->
            <div class="row mt-2">
                <div class="col-md-6"></div> <!-- kosong kiri -->

                <div class="col-md-6">
                    <form method="GET" action="/penilaian">
                        <div class="row g-2 justify-content-md-end">

                            <div class="col-auto">
                                <select name="periode_id" id="periode" class="form-select" onchange="this.form.submit()">
                                    @foreach ($periodeList as $p)
                                        <option value="{{ $p->id }}" {{ $periode_id == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama_periode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-auto">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>Belum
                                    </option>
                                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses
                                    </option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- CONTENT -->
        <section class="section">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title">Data Calon Penerima</h5>
                </div>

                <div class="card-body">


                    <table class="table table-striped table-responsive" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Calon Penerima</th>
                                <th>Kelengkapan</th>
                                <th>Nilai Rata-rata</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        @if (count($penduduk) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Tidak ada data penilaian
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($penduduk as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <!-- Nama -->
                                        <td>
                                            <strong>{{ $item->nama }}</strong><br>
                                            <small>Desa: {{ $item->desa }}</small>
                                        </td>

                                        <!-- Kelengkapan -->
                                        <td>
                                            {{ $item->kelengkapan }}
                                        </td>

                                        <!-- Nilai rata-rata -->
                                        <td>
                                            {{ $item->rata_rata ?? '-' }}
                                        </td>

                                        <!-- Status -->
                                        <td>
                                            <span class="badge bg-{{ $item->badge }}">
                                                {{ $item->status_label }}
                                            </span>
                                        </td>

                                        <!-- Aksi -->
                                        <td>
                                            <a href="/penilaian/{{ $item->id }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-plus-circle"></i>
                                            </a>

                                            <button class="btn btn-sm btn-info text-white btn-detail"
                                                data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                                data-bs-toggle="modal" data-bs-target="#modalDetail">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>


                                            <a href="/penilaian/{{ $item->id }}/edit?periode_id={{ request('periode_id') ?? $periode_id }}"
                                                class="btn btn-warning btn-sm text-white">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $item->id }}">
                                                <i class="bi bi-eraser-fill"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- MODAL HAPUS -->
                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    Yakin ingin menghapus data
                                                    <strong>{{ $item->nama }}</strong>?
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Batal
                                                    </button>

                                                    <form action="/penilaian/{{ $item->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        @endif

                    </table>

                    <!-- MODAL DETAIL -->
                    <div class="modal fade" id="modalDetail" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Penilaian</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <h6 id="namaPenduduk"></h6>

                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                <th>Subkriteria</th>
                                                <th>Nilai</th>
                                                <th>Bukti</th>
                                                <th>Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="detailBody">
                                            <tr>
                                                <td colspan="5" class="text-center">Loading...</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
