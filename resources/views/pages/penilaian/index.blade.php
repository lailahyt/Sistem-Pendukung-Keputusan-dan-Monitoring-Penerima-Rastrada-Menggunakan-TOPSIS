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
                                <th>Status</th>
                                <th style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>

                        @if (count($penduduk) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center">
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
                                            <small>Umur: {{ $item->usia }} tahun</small>
                                        </td>

                                        <!-- Kelengkapan -->
                                        <td>
                                            {{ $item->kelengkapan }}
                                        </td>

                                        <!-- Status -->
                                        <td>
                                            <span class="badge bg-{{ $item->badge }}">
                                                {{ $item->status_label }}
                                            </span>
                                        </td>

                                        <!-- Aksi -->
                                        <td>
                                            <div class="d-flex gap-1 flex-nowrap">

                                                {{-- Tambah hanya jika penilaian belum selesai --}}
                                                @if ($item->status !== 'selesai')
                                                    <a href="/penilaian/{{ $item->id }}?periode_id={{ $periode_id }}"
                                                        class="btn btn-primary btn-sm" title="Tambah Penilaian">
                                                        <i class="bi bi-plus-circle"></i>
                                                    </a>
                                                @endif

                                                {{-- Detail selalu tersedia --}}
                                                <button class="btn btn-sm btn-info text-white btn-detail"
                                                    data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                                    data-bs-toggle="modal" data-bs-target="#modalDetail"
                                                    title="Lihat Detail Penilaian">

                                                    <i class="bi bi-eye-fill"></i>

                                                </button>

                                                @if ($item->status == 'selesai')
                                                    <button type="button"
                                                        class="btn btn-warning btn-sm text-white btn-edit-confirm"
                                                        data-url="/penilaian/{{ $item->id }}/edit?periode_id={{ request('periode_id') ?? $periode_id }}"
                                                        data-nama="{{ $item->nama }}">

                                                        <i class="bi bi-pencil-square"></i>

                                                    </button>
                                                @else
                                                    <a href="/penilaian/{{ $item->id }}/edit?periode_id={{ request('periode_id') ?? $periode_id }}"
                                                        class="btn btn-warning btn-sm text-white">

                                                        <i class="bi bi-pencil-square"></i>

                                                    </a>
                                                @endif

                                                @if ($item->status == 'selesai')
                                                    <button type="button" class="btn btn-danger btn-sm btn-delete-confirm"
                                                        data-target="#deleteModal{{ $item->id }}"
                                                        data-nama="{{ $item->nama }}">

                                                        <i class="bi bi-eraser-fill"></i>

                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $item->id }}">

                                                        <i class="bi bi-eraser-fill"></i>

                                                    </button>
                                                @endif

                                            </div>
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

                                                        <input type="hidden" name="periode_id"
                                                            value="{{ $periode_id }}">

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
                        <div class="modal-dialog modal-fullscreen-sm-down modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Penilaian</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <h6 id="namaPenduduk"></h6>

                                    <div class="table-responsive">
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

                    <!-- MODAL PREVIEW BUKTI -->
                    <div class="modal fade" id="modalPreview" tabindex="-1">

                        <div class="modal-dialog modal-lg modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="previewTitle">

                                        Bukti Penilaian

                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body text-center">

                                    <div id="previewContainer">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal fade" id="modalEditConfirm" tabindex="-1">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">

                                        Konfirmasi Edit Penilaian

                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body">

                                    <p>

                                        Data penilaian ini telah berstatus
                                        <strong>Selesai</strong>.

                                    </p>

                                    <p>

                                        Perubahan dapat memengaruhi hasil
                                        <strong>perhitungan TOPSIS.</strong>

                                    </p>

                                    <p class="mb-0">

                                        Apakah Anda ingin melanjutkan?

                                    </p>

                                </div>

                                <div class="modal-footer">

                                    <button class="btn btn-secondary" data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <a href="#" class="btn btn-warning" id="btnLanjutEdit">

                                        Ya, Lanjutkan

                                    </a>

                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- MODAL KONFIRMASI HAPUS -->
                    <div class="modal fade" id="modalDeleteConfirm" tabindex="-1">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">

                                        Konfirmasi Hapus Penilaian

                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body">

                                    <p>

                                        Data penilaian ini telah berstatus
                                        <strong>Selesai</strong>.

                                    </p>

                                    <p>

                                        Menghapus data ini akan menghapus seluruh
                                        hasil penilaian beserta bukti yang telah
                                        diunggah dan dapat memengaruhi hasil
                                        perhitungan TOPSIS.

                                    </p>

                                    <p class="mb-0">

                                        Apakah Anda ingin melanjutkan?

                                    </p>

                                </div>

                                <div class="modal-footer">

                                    <button class="btn btn-secondary" data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <button class="btn btn-danger" id="btnLanjutDelete">

                                        Ya, Lanjutkan

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
