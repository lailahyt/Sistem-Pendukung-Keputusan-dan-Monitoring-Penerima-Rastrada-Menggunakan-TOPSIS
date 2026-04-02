@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Ubah Data Penduduk</h3>
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
                        <h4 class="card-title">Form Ubah Data Penduduk</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/resident/{{ $resident->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">NIK</label>
                                            <input type="number" id="nik" inputmode="numeric" class="form-control @error('nik') is-invalid @enderror" placeholder="Nomor NIK"
                                            name="nik" value="{{ old('nik', $resident->nik ) }}" required>
                                            @error('nik')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Nama</label>
                                            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                            placeholder="Nama Lengkap" value="{{ old('nama', $resident->nama) }}" required>
                                            @error('nama')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                            placeholder="Alamat"
                                            required>{{ old('alamat', $resident->alamat) }}</textarea>
                                            @error('alamat')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Desa</label>
                                            <input type="text" id="desa" class="form-control @error('desa') is-invalid @enderror"
                                                name="desa" placeholder="Desa" value="{{ old('desa', $resident->desa) }}" required>
                                            @error('desa')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Kecamatan</label>
                                            <input type="text" id="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror"
                                                name="kecamatan" placeholder="Kecamatan" value="{{ old('kecamatan', $resident->kecamatan) }}" required>
                                            @error('kecamatan')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Penghasilan</label>
                                            <input type="number" id="penghasilan" class="form-control @error('penghasilan') is-invalid @enderror"
                                            name="penghasilan" placeholder="Penghasilan" value="{{ old('penghasilan', $resident->penghasilan) }}" required>
                                            @error('penghasilan')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Tanggungan</label>
                                            <input type="number" id="tanggungan" class="form-control @error('tanggungan') is-invalid @enderror" name="tanggungan"
                                            placeholder="Jumlah Tanggungan" value="{{ old('tanggungan', $resident->tanggungan) }}" required>
                                            @error('tanggungan')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Kondisi Rumah</label>
                                            <select id="kondisi_rumah" name="kondisi_rumah" class="form-control @error('kondisi_rumah') is-invalid @enderror" required>
                                                <option value="">-- Pilih Kondisi --</option>
                                                <option value="buruk" {{ old('kondisi_rumah', $resident->kondisi_rumah) == 'buruk' ? 'selected' : '' }}>Buruk</option>
                                                <option value="sedang" {{ old('kondisi_rumah', $resident->kondisi_rumah) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                                <option value="baik" {{ old('kondisi_rumah', $resident->kondisi_rumah) == 'baik' ? 'selected' : '' }}>Baik</option>
                                            </select>
                                            @error('kondisi_rumah')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <a href="/resident" class="btn btn-outline-secondary me-1 mb-1">Kembali</a>
                                        <button type="submit" class="btn btn-warning me-1 mb-1">Simpan</button>
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
