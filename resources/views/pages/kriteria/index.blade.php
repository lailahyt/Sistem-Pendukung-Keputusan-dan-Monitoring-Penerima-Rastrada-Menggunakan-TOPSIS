@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Kriteria</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Kriteria</li>
                        </ol>
                    </nav>

                    <!-- Tombol Tambah: hanya Admin -->
                    @if(auth()->user()->role_id == 1)
                        <div class="text-md-end mt-2 mb-3">
                            <a href="/kriteria/create" class="btn btn-sm btn-primary shadow-sm">
                                <i class="bi bi-plus"></i> Tambah Data
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Kriteria</h5>
                        <small class="text-muted">Total {{ $kriteria->count() }} kriteria terdaftar</small>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Atribut</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        @if (count($kriteria) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data kriteria</td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($kriteria as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->nama_kriteria }}</td>
                                        <td>{{ $item->bobot }}</td>
                                        <td>{{ $item->atribut }}</td>
                                        <td>
                                            @if ($item->is_active)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center" style="gap: 10px;">

                                                <!-- SUBKRITERIA: semua role boleh lihat -->
                                                <a href="/kriteria/{{ $item->id }}/subkriteria"
                                                    class="btn btn-sm btn-info text-white"
                                                    title="Kelola Subkriteria">
                                                    <i class="bi bi-list-ul"></i>
                                                    <span class="d-none d-md-inline ms-1">Sub</span>
                                                </a>

                                                <!-- EDIT, HAPUS, TOGGLE: hanya Admin -->
                                                @if(auth()->user()->role_id == 1)

                                                    <!-- EDIT -->
                                                    <a href="/kriteria/{{ $item->kode }}"
                                                        class="btn btn-warning btn-sm"
                                                        title="Edit">
                                                        <i class="bi bi-pencil-fill text-white"></i>
                                                    </a>

                                                    <!-- HAPUS -->
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $item->kode }}"
                                                        title="Hapus">
                                                        <i class="bi bi-eraser-fill"></i>
                                                    </button>

                                                    <!-- TOGGLE ON/OFF -->
                                                    <form action="/kriteria/{{ $item->id }}/toggle" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-sm {{ $item->is_active ? 'btn-secondary' : 'btn-success' }}"
                                                            title="Toggle Status">
                                                            {{ $item->is_active ? 'OFF' : 'ON' }}
                                                        </button>
                                                    </form>

                                                @endif
                                                {{-- Lurah & Petugas: hanya tombol lihat di atas --}}

                                            </div>
                                        </td>
                                    </tr>

                                    <!-- MODAL HAPUS: hanya di-render jika Admin -->
                                    @if(auth()->user()->role_id == 1)
                                        <div class="modal fade" id="deleteModal{{ $item->kode }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        Yakin ingin menghapus data
                                                        <strong>{{ $item->nama_kriteria }}</strong>?
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Batal
                                                        </button>
                                                        <form action="/kriteria/{{ $item->kode }}" method="POST">
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
                                    @endif

                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
