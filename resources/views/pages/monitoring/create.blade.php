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
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Form Pencatatan Pengambilan Bantuan</h5>
                    </div>
                    <div class="card-body">

                        {{-- Info Warga --}}
                        <div class="alert alert-info d-flex gap-3 align-items-start mb-4">
                            <i class="bi bi-person-circle fs-4"></i>
                            <div>
                                <p class="mb-0 fw-bold">Nurjanah</p>
                                <p class="mb-0 text-muted" style="font-size:13px">NIK: 3204010101010001</p>
                                <p class="mb-0 text-muted" style="font-size:13px">Desa: Sukamaju &bull; Rank TOPSIS: #1</p>
                            </div>
                        </div>

                        <form action="/distribusi/store" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="penduduk_id" value="1">
                            <input type="hidden" name="petugas_id" value="1">
                            <input type="hidden" name="tanggal_ambil" value="{{ now() }}">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal & Jam Kedatangan</label>
                                    <input type="text" class="form-control"
                                        value="{{ now()->format('d M Y, H:i') }}" disabled>
                                    <small class="text-muted">Otomatis tercatat saat disimpan</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Petugas yang Melayani</label>
                                    <input type="text" class="form-control" value="Admin" disabled>
                                    <small class="text-muted">Sesuai akun yang login</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Diambil Oleh</label>
                                <select name="diambil_oleh" class="form-select">
                                    <option value="sendiri">Sendiri</option>
                                    <option value="diwakilkan">Diwakilkan</option>
                                </select>
                            </div>

                            <div class="mb-3" id="wrap-nama-wakil" style="display:none">
                                <label class="form-label">Nama Perwakilan</label>
                                <input type="text" name="nama_wakil" class="form-control"
                                    placeholder="Masukkan nama perwakilan">
                                <small class="text-muted">Isi jika diwakilkan</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto Bukti / KTP <span class="text-muted">(opsional)</span></label>
                                <input type="file" name="foto_bukti" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea name="catatan" class="form-control" rows="3"
                                    placeholder="Catatan tambahan jika ada..."></textarea>
                            </div>

                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg"></i> Konfirmasi Sudah Ambil
                                </button>
                                <a href="/monitoring" class="btn btn-secondary">Kembali</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.querySelector('[name="diambil_oleh"]').addEventListener('change', function() {
        const wrap = document.getElementById('wrap-nama-wakil');
        wrap.style.display = this.value === 'diwakilkan' ? 'block' : 'none';
    });
</script>
@endsection
