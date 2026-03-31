@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Penduduk</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Penduduk</li>
                    </ol>
                </nav>

                <!-- Tombol di bawah breadcrumb -->
                <div class="text-md-end mt-2 mb-3">
                    <a href="/resident/create" class="btn btn-sm btn-primary shadow-sm">
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
                    Data Penduduk
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Penghasila</th>
                            <th>Tanggungan</th>
                            <th>Kondisi Rumah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Penghasila</th>
                            <th>Tanggungan</th>
                            <th>Kondisi Rumah</th>
                            <th>
                                <div class="d-flex align-items-center" style="gap: 10px;" >
                                    <a href="/resident/" class="d-inline-block btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    {{-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationDelete{{ }}">
                                        <i class="fas fa-eraser"></i>
                                    </button> --}}
                                </div>
                            </th>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
