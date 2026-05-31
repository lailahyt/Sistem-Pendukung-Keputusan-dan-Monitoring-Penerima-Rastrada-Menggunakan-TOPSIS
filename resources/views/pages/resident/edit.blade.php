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
                        <li class="breadcrumb-item active" aria-current="page">Edit Penduduk</li>
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
                                            <label for="age-column">Usia</label>
                                            <input type="number" id="usia" name="usia" class="form-control @error('usia') is-invalid @enderror"
                                            placeholder="Usia" value="{{ old('usia', $resident->usia) }}" required>
                                            @error('usia')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="gender-column">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L" {{ old('jenis_kelamin', $resident->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin', $resident->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
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
                                            <label>RW</label>

                                            <select id="rw" class="form-control">

                                                <option value="">Pilih RW</option>

                                                @foreach ($wilayah->unique('rw') as $w)

                                                    <option value="{{ $w->rw }}"
                                                        {{ $resident->wilayah?->rw == $w->rw ? 'selected' : '' }}>

                                                        RW {{ $w->rw }}

                                                    </option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>RT</label>

                                            <select id="rt"
                                                name="wilayah_id"
                                                class="form-control">

                                                <option value="">Pilih RT</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="active" {{ old('status', $resident->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                                <option value="moved" {{ old('status', $resident->status) == 'moved' ? 'selected' : '' }}>Pindah</option>
                                                <option value="deceased" {{ old('status', $resident->status) == 'deceased' ? 'selected' : '' }}>Meninggal</option>
                                            </select>
                                            @error('status')
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

<script>

    const wilayah = @json($wilayah);

    const rwSelect = document.getElementById('rw');
    const rtSelect = document.getElementById('rt');

    const selectedWilayahId = "{{ $resident->wilayah_id }}";

    function loadRT(selectedRw) {

        rtSelect.innerHTML = '<option value="">Pilih RT</option>';

        if (selectedRw) {

            rtSelect.disabled = false;

            wilayah.forEach(function(item) {

                if (item.rw == selectedRw) {

                    rtSelect.innerHTML += `
                        <option value="${item.id}"
                            ${item.id == selectedWilayahId ? 'selected' : ''}>

                            RT ${item.rt}

                        </option>
                    `;
                }

            });

        } else {

            rtSelect.disabled = true;
        }
    }

    loadRT(rwSelect.value);

    rwSelect.addEventListener('change', function () {

        loadRT(this.value);

    });

</script>
@endsection
