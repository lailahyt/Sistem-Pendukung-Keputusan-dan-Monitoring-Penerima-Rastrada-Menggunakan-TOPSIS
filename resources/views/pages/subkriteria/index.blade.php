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
                            </tr>
                        </thead>

                        @if (count($subkriteria) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="4" class="text-center">
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

                                        <td>{{ $item->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif

                    </table>
                </div>
            </div>
        </section>

    </div>
@endsection
