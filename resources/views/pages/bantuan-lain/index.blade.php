@extends('layouts.app')

@section('content')
    <div class="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Bantuan Lain</h3>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">

                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Bantuan Lain
                            </li>
                        </ol>
                    </nav>

                    @if (auth()->user()->role_id == 2)
                        <div class="text-md-end mt-2 mb-3">
                            <a href="/bantuan-lain/create" class="btn btn-sm btn-primary shadow-sm">
                                <i class="bi bi-plus"></i>
                                Tambah Data
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <section class="section">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="card-title mb-0">
                            Data Bantuan Lain
                        </h5>

                        <small class="text-muted">
                            Total {{ $dataBantuan->count() }} data bantuan
                        </small>
                    </div>

                </div>

                <div class="card-body">

                    <form method="GET" action="/bantuan-lain">

                        <div class="row mb-3 g-2 align-items-end">

                            <div class="col-md-3">
                                <label class="form-label mb-1">
                                    Tahun
                                </label>

                                <select name="tahun" class="form-select form-select-sm">

                                    <option value="">
                                        Semua Tahun
                                    </option>

                                    @for ($tahun = date('Y'); $tahun >= date('Y') - 5; $tahun--)
                                        <option value="{{ $tahun }}"
                                            {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                            {{ $tahun }}
                                        </option>
                                    @endfor

                                </select>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-sm btn-primary w-100">
                                    <i class="bi bi-search"></i>
                                    Filter
                                </button>
                            </div>

                            <div class="col-md-2">
                                <a href="/bantuan-lain" class="btn btn-sm btn-secondary w-100">
                                    <i class="bi bi-x"></i>
                                    Reset
                                </a>
                            </div>

                        </div>

                    </form>

                    <table class="table table-striped table-responsive" id="table1">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama Penduduk</th>
                                <th>RW / RT</th>
                                <th>Nama Bantuan</th>
                                <th>Tahun</th>

                                @if (auth()->user()->role_id == 2)
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($dataBantuan as $item)
                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $item->resident->nik ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->resident->nama ?? '-' }}
                                    </td>

                                    <td>
                                        RW {{ $item->resident->wilayah->rw ?? '-' }}
                                        /
                                        RT {{ $item->resident->wilayah->rt ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->nama_bantuan }}
                                    </td>

                                    <td>
                                        {{ $item->tahun }}
                                    </td>

                                    @if (auth()->user()->role_id == 2)
                                        <td>

                                            <div class="d-flex" style="gap:8px">

                                                <a href="/bantuan-lain/{{ $item->id }}/edit"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit text-white"></i>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </div>

                                        </td>
                                    @endif

                                </tr>

                                <!-- MODAL HAPUS -->
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Konfirmasi Hapus
                                                </h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                Yakin ingin menghapus data bantuan
                                                <strong>
                                                    {{ $item->resident->nama ?? '-' }}
                                                </strong>
                                                ?
                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>

                                                <form action="/bantuan-lain/{{ $item->id }}" method="POST">

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
                            @empty

                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">

                                        <i class="bi bi-inbox fs-5 d-block mb-1"></i>

                                        Tidak ada data bantuan lain

                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </section>

    </div>
@endsection
