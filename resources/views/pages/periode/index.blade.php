@extends('layouts.app')
@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">

                <!-- Judul -->
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Periode</h3>
                    <p>Agar seleksi dapat dilakukan berkali-kali</p>
                </div>

                <!-- Breadcrumb + Tombol -->
                <div class="col-12 col-md-6 order-md-2 order-first">

                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Periode</li>
                        </ol>
                    </nav>

                    <div class="text-md-end mt-2 mb-3">
                        <button class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal"
                            data-bs-target="#modalTambah">
                            <i class="bi bi-plus"></i> Tambah Data
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title">Data Periode Seleksi</h5>
                        <small class="text-muted">Total {{ $periode->count() }} periode terdaftar</small>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-responsive" id="table1">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Periode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        @if (count($periode) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        Tidak ada data periode
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($periode as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_periode }}</td>
                                        <td>
                                            <div class="d-flex align-items-center" style="gap: 10px;">

                                                <!-- EDIT -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="bi bi-pencil-fill text-white"></i>
                                                </button>

                                                <!-- DELETE -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $item->id }}">
                                                    <i class="bi bi-eraser-fill"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                                    <!-- MODAL EDIT -->
                                    <div class="modal fade" id="editModal{{ $item->id }}">
                                        <div class="modal-dialog">
                                            <form method="POST" action="/periode/{{ $item->id }}">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5>Edit Periode</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <input type="text" name="nama_periode" class="form-control"
                                                            value="{{ $item->nama_periode }}">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- MODAL DELETE -->
                                    <div class="modal fade" id="deleteModal{{ $item->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5>Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    Yakin ingin menghapus periode
                                                    <strong>{{ $item->nama_periode }}</strong>?
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Batal
                                                    </button>

                                                    <form method="POST" action="/periode/{{ $item->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        @endif

                    </table>
                </div>

            </div>
        </section>
    </div>

    <!-- MODAL TAMBAH -->
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <form method="POST" action="/periode">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Tambah Periode</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="text" name="nama_periode" class="form-control"
                            placeholder="Contoh: Seleksi Januari 2026">
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Simpan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
