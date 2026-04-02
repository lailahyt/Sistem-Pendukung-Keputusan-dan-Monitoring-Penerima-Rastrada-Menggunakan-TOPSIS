@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Data Penduduk</h3>
                <p></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Layout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Tambah Penduduk</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/resident" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">NIK</label>
                                            <input type="number" inputmode="numeric" class="form-control" placeholder="Nomor NIK" name="nik" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Nama</label>
                                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Alamat</label>
                                            <textarea name="alamat" class="form-control" placeholder="Alamat" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Desa</label>
                                            <input type="text" id="desa" class="form-control"
                                                name="desa" placeholder="Desa">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Kecamatan</label>
                                            <input type="text" id="kecamatan" class="form-control"
                                                name="kecamatan" placeholder="Kecamatan">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Penghasilan</label>
                                            <input type="number" class="form-control" name="penghasilan" placeholder="Penghasilan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Tanggungan</label>
                                            <input type="number" class="form-control" name="tanggungan" placeholder="Jumlah Tanggungan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Kondisi Rumah</label>
                                            <select name="kondisi_rumah" class="form-control" required>
                                                <option value="">-- Pilih Kondisi --</option>
                                                <option value="buruk">Buruk</option>
                                                <option value="sedang">Sedang</option>
                                                <option value="baik">Baik</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <a href="/resident" class="btn btn-outline-secondary me-1 mb-1">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

@endsection
