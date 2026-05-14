@extends('layouts.app')

@section('content')
    <div class="page-heading">

        <div class="page-title">
            <div class="row">

                <!-- Judul -->
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        Subkriteria — {{ $kriteria->nama_kriteria }}
                    </h3>
                    <p class="text-subtitle text-muted">
                        {{ $kriteria->kode }} · Bobot {{ $kriteria->bobot }} · Atribut {{ $kriteria->atribut }}
                    </p>
                </div>

                <!-- Breadcrumb + Tombol -->
                <div class="col-12 col-md-6 order-md-2 order-first">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="/kriteria">Data Kriteria</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Subkriteria
                            </li>
                        </ol>
                    </nav>

                    <!-- Tombol -->
                    <div class="text-md-end mt-2 mb-3">

                        <!-- Tombol kembali -->
                        <a href="/kriteria" class="btn btn-sm btn-secondary shadow-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>

                        <!-- Tambah subkriteria -->
                        <a href="/kriteria/{{ $kriteria->id }}/subkriteria/create" class="btn btn-sm btn-primary shadow-sm">
                            <i class="bi bi-plus"></i> Tambah Subkriteria
                        </a>

                    </div>

                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Data Subkriteria {{ $kriteria->kode }} — {{ $kriteria->nama_kriteria }}
                    </h5>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-responsive" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Label Subkriteria</th>
                                <th>Nilai</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        @if (count($subkriteria) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Belum ada subkriteria
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($subkriteria as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $item->label_subkriteria }}</td>

                                        <!-- NILAI DENGAN BADGE -->
                                        <td>
                                            <span
                                                class="badge bg-{{ $item->nilai == 1
                                                    ? 'danger'
                                                    : ($item->nilai == 2
                                                        ? 'warning'
                                                        : ($item->nilai == 3
                                                            ? 'primary'
                                                            : ($item->nilai == 4
                                                                ? 'info'
                                                                : 'success'))) }}">
                                                {{ $item->nilai }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $item->keterangan }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center" style="gap: 10px;">

                                                <button type="button" class="btn btn-warning btn-sm text-white"
                                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">

                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

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
                                                    <strong>{{ $item->label_subkriteria }}</strong>?
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Batal
                                                    </button>

                                                    <form action="/subkriteria/{{ $item->id }}" method="POST">
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

                                    <!-- MODAL EDIT -->
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">

                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <form action="/subkriteria/{{ $item->id }}" method="POST">

                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            Edit Subkriteria
                                                        </h5>

                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <!-- Label -->
                                                        <div class="mb-3">
                                                            <label class="form-label">
                                                                Label Subkriteria
                                                            </label>

                                                            <input type="text" name="label_subkriteria"
                                                                class="form-control" value="{{ $item->label_subkriteria }}"
                                                                required>
                                                        </div>

                                                        <!-- Nilai -->
                                                        <div class="mb-3">
                                                            <label class="form-label">
                                                                Nilai
                                                            </label>

                                                            <select name="nilai" class="form-select" required>

                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <option value="{{ $i }}"
                                                                        {{ $item->nilai == $i ? 'selected' : '' }}>
                                                                        {{ $i }}
                                                                    </option>
                                                                @endfor

                                                            </select>
                                                        </div>

                                                        <!-- Keterangan -->
                                                        <div class="mb-3">
                                                            <label class="form-label">
                                                                Keterangan
                                                            </label>

                                                            <textarea name="keterangan" class="form-control" rows="3">{{ $item->keterangan }}</textarea>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">

                                                            Batal
                                                        </button>

                                                        <button type="submit" class="btn btn-warning text-white">

                                                            Update
                                                        </button>

                                                    </div>

                                                </form>

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
