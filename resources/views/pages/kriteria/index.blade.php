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

                    <!-- Tombol di bawah breadcrumb -->
                    <div class="text-md-end mt-2 mb-3">
                        <a href="/kriteria/create" class="btn btn-sm btn-primary shadow-sm">
                            <i class="bi bi-plus"></i> Tambah Data
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Data Kriteria
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @if (count($kriteria) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data kriteria</td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($kriteria as $item)
                                    <tr>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->nama_kriteria }}</td>
                                        <td>{{ $item->bobot }}</td>
                                        <th>
                                            <div class="d-flex align-items-center" style="gap: 10px;">
                                                <a href="/kriteria/{{ $item->kode }}"
                                                    class="d-inline-block btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#confirmationDelete{{ $item->kode }}">
                                                    <i class="bi bi-eraser-fill"></i>
                                                </button>
                                            </div>
                                        </th>

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
