@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Pegawai</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Pegawai</li>
                        </ol>
                    </nav>

                    <!-- Tombol tambah -->
                    <div class="text-md-end mt-2 mb-3">
                        <a href="/employee/create" class="btn btn-sm btn-primary shadow-sm">
                            <i class="bi bi-plus"></i> Tambah Data
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Pegawai</h5>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-responsive" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>No HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        @if (count($pegawai) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Tidak ada data pegawai
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($pegawai as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nip }}</td>

                                        <!-- Badge Jabatan -->
                                        <td>
                                            <span
                                                class="badge bg-{{ $item->jabatan == 'Lurah' ? 'success' : 'secondary' }}">
                                                {{ $item->jabatan }}
                                            </span>
                                        </td>

                                        <td>{{ $item->no_hp }}</td>

                                        <td>
                                            <div class="d-flex align-items-center" style="gap: 10px;">
                                                <a href="/employee/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-fill text-white"></i>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $item->id }}">
                                                    <i class="bi bi-eraser-fill"></i>
                                                </button>
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

                                                    <form action="/employee/{{ $item->id }}" method="POST">
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
                </div>
            </div>
        </section>
    </div>
@endsection
