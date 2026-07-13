@extends('layouts.app')

@section('content')
    <div class="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Data Bantuan Lain</h3>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="/bantuan-lain">Data Bantuan Lain</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tambah Data
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">
                        Form Tambah Data Bantuan Lain
                    </h5>
                </div>

                <div class="card-body">

                    <form action="/bantuan-lain" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">
                                Penduduk <span class="text-danger">*</span>
                            </label>

                            <select name="penduduk_id" class="form-select @error('penduduk_id') is-invalid @enderror"
                                required>

                                <option value="">
                                    -- Pilih Penduduk --
                                </option>

                                @foreach ($residents as $resident)
                                    <option value="{{ $resident->id }}"
                                        {{ old('penduduk_id') == $resident->id ? 'selected' : '' }}>

                                        {{ $resident->nik }}
                                        -
                                        {{ $resident->nama }}

                                    </option>
                                @endforeach

                            </select>

                            @error('penduduk_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Nama Bantuan <span class="text-danger">*</span>
                            </label>

                            <select name="nama_bantuan" class="form-select @error('nama_bantuan') is-invalid @enderror"
                                required>

                                <option value="">
                                    -- Pilih Bantuan --
                                </option>

                                <option value="JADUP" {{ old('nama_bantuan') == 'JADUP' ? 'selected' : '' }}>
                                    JADUP
                                </option>

                                <option value="BERUPAYA" {{ old('nama_bantuan') == 'BERUPAYA' ? 'selected' : '' }}>
                                    BERUPAYA
                                </option>

                                <option value="Bedah Rumah" {{ old('nama_bantuan') == 'Bedah Rumah' ? 'selected' : '' }}>
                                    Bedah Rumah
                                </option>

                                <option value="Bantuan Sosial Lainnya"
                                    {{ old('nama_bantuan') == 'Bantuan Sosial Lainnya' ? 'selected' : '' }}>
                                    Bantuan Sosial Lainnya
                                </option>

                            </select>

                            @error('nama_bantuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Tahun <span class="text-danger">*</span>
                            </label>

                            <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                                value="{{ old('tahun', date('Y')) }}" min="2020" max="2100" required>

                            @error('tahun')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="d-flex justify-content-end gap-2">

                            <a href="/bantuan-lain" class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i>
                                Simpan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </section>

    </div>
@endsection
