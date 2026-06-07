@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Catat Pengambilan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/monitoring">Monitoring</a></li>
                            <li class="breadcrumb-item active">Catat Pengambilan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Form Pencatatan Pengambilan Bantuan</h5>
                        </div>
                        <div class="card-body">

                            {{-- Info Warga --}}
                            <div class="alert alert-dark d-flex gap-3 align-items-start mb-4">
                                <i class="bi bi-person-circle fs-4"></i>
                                <div>
                                    <p class="mb-0 fw-bold">
                                        {{ $monitoring->resident->nama }}
                                    </p>
                                    <p class="mb-0 text-bold" style="font-size:13px">NIK: {{ $monitoring->resident->nik }}
                                    </p>
                                    <p class="mb-0 text-bold" style="font-size:13px">Desa:
                                        {{ $monitoring->resident->desa }} &bull; Rank TOPSIS: #{{ $monitoring->rank }}
                                    </p>
                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">

                                    <ul class="mb-0">

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach

                                    </ul>

                                </div>
                            @endif

                            <form action="/monitoring/{{ $monitoring->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal & Jam Kedatangan</label>
                                        <input type="text" class="form-control" value="{{ now()->format('d M Y, H:i') }}"
                                            disabled>
                                        <small class="text-muted">Otomatis tercatat saat disimpan</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Petugas yang Melayani</label>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::user()->name ?? 'Admin' }}" disabled>
                                        <small class="text-muted">Sesuai akun yang login</small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Diambil Oleh</label>
                                    <select name="diambil_oleh" class="form-select">
                                        <option value="sendiri" {{ old('diambil_oleh') == 'sendiri' ? 'selected' : '' }}>
                                            Sendiri
                                        </option>

                                        <option value="diwakilkan"
                                            {{ old('diambil_oleh') == 'diwakilkan' ? 'selected' : '' }}>
                                            Diwakilkan
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3" id="wrap-nama-wakil" style="display:none">
                                    <label class="form-label">Nama Perwakilan</label>
                                    <input type="text" name="nama_wakil" class="form-control"
                                        value="{{ old('nama_wakil') }}">
                                    <small class="text-muted">Isi jika diwakilkan</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto Bukti / KTP <span
                                            class="text-muted">(opsional)</span></label>
                                    <input type="file" name="foto_bukti" class="form-control" accept="image/*">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Catatan</label>
                                    <textarea name="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
                                </div>

                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="/monitoring" class="btn btn-secondary">
                                        Kembali
                                    </a>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg"></i> Konfirmasi Sudah Ambil
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const select = document.querySelector('[name="diambil_oleh"]');
            const wrap = document.getElementById('wrap-nama-wakil');

            function toggleWakil() {

                wrap.style.display =
                    select.value === 'diwakilkan' ?
                    'block' :
                    'none';
            }

            toggleWakil();

            select.addEventListener('change', toggleWakil);

        });
    </script>

@endsection
