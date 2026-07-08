@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Data Pegawai</h3>
                    <p></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Pegawai</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Input Pegawai</h5>
                </div>

                <div class="card-body">
                    <form action="/employee" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Nama Pegawai</label>
                                <input type="text" name="nama" class="form-control"
                                    placeholder="Masukkan nama pegawai" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>NIP</label>
                                <input
                                    type="text"
                                    name="nip"
                                    class="form-control"
                                    placeholder="Masukkan NIP (opsional)"
                                    maxlength="18"
                                    minlength="18"
                                    inputmode="numeric"
                                    pattern="[0-9]{18}"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Jabatan</label>
                                <select name="jabatan" class="form-control" required>
                                    <option value="">-- Pilih Jabatan --</option>
                                    <option value="Pegawai">Pegawai</option>
                                    <option value="Lurah">Lurah</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>No HP</label>
                                <input type="text" name="no_hp" class="form-control" maxlength="13" minlength="10"
                                    pattern="08[0-9]{8,11}" inputmode="numeric" placeholder="Contoh: 081234567890">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat"></textarea>
                            </div>

                        </div>

                        <div class="mt-3 d-flex justify-content-end gap-2">
                            <a href="/employee" class="btn btn-outline-secondary me-1 mb-1">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
