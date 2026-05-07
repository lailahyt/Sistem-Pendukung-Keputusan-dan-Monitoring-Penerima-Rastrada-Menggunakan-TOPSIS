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

                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>

                            <li class="breadcrumb-item active">
                                Laporan
                            </li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

        <section class="section">

            {{-- FILTER --}}
            <div class="card mb-4">

                <div class="card-body py-3">

                    <form method="GET" action="/report">

                        <div class="row g-2 align-items-end">

                            <div class="col-12 col-md-3">

                                <label class="form-label mb-1" style="font-size:13px">

                                    Periode / Tahun

                                </label>

                                <select name="periode_id" class="form-select form-select-sm">

                                    @foreach ($periodeList as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $periode_id == $item->id ? 'selected' : '' }}>

                                            {{ $item->nama_periode }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-12 col-md-2">

                                <button type="submit" class="btn btn-sm btn-primary w-100">

                                    <i class="bi bi-search"></i>
                                    Tampilkan

                                </button>

                            </div>

                            <div class="col-12 col-md-3"></div>

                            <div class="col-12 col-md-4 d-flex gap-2 justify-content-md-end">

                                <a href="/report/export-pdf?periode_id={{ $periode_id }}" class="btn btn-danger">
                                    Export PDF
                                </a>

                                <a href="/report/export-excel?periode_id={{ $periode_id }}" class="btn btn-success">
                                    Export Excel
                                </a>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            {{-- TABEL --}}
            <div class="card">

                <div class="card-header">

                    <h5 class="card-title mb-0">

                        Detail Penerima Bantuan
                        Periode {{ $periode->nama_periode }}

                    </h5>

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

                            @forelse ($laporan as $item)
                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="fw-bold">
                                        {{ $item->resident->nama ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->resident->nik ?? '-' }}
                                    </td>

                                    <td>

                                        @if ($item->rank == 1)
                                            <span class="badge bg-warning text-dark">
                                                #1
                                            </span>
                                        @elseif ($item->rank == 2)
                                            <span class="badge bg-secondary">
                                                #2
                                            </span>
                                        @elseif ($item->rank == 3)
                                            <span class="badge" style="background:#cd7f32">

                                                #3

                                            </span>
                                        @else
                                            <span class="badge bg-light text-dark border">

                                                #{{ $item->rank }}

                                            </span>
                                        @endif

                                    </td>

                                    <td>
                                        {{ number_format($item->nilai_preferensi, 3) }}
                                    </td>

                                    <td>

                                        @if ($item->status_pengambilan == 'sudah_ambil')
                                            <span class="badge bg-success">
                                                Sudah Ambil
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                Belum Ambil
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($item->tanggal_ambil)
                                            {{ \Carbon\Carbon::parse($item->tanggal_ambil)->format('d M Y, H:i') }}
                                        @else
                                            -
                                        @endif

                                    </td>

                                    <td>
                                        {{ $item->diambil_oleh ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->petugas ?? '-' }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="text-center text-muted">

                                        Tidak ada data laporan

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
