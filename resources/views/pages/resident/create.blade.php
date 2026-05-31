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
                            <li class="breadcrumb-item active" aria-current="page">Tambah Penduduk</li>
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
                                                <input type="number" inputmode="numeric"
                                                    class="form-control @error('nik') is-invalid @enderror"
                                                    placeholder="Nomor NIK" name="nik" value="{{ old('nik') }}"
                                                    required>
                                                @error('nik')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column">Nama</label>
                                                <input type="text" name="nama"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                                                @error('nama')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="age-column">Usia</label>
                                                <input type="number" id="usia" name="usia" class="form-control @error('usia') is-invalid @enderror"
                                                    placeholder="Usia" value="{{ old('usia') }}" required>
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
                                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="city-column">Alamat</label>
                                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat"
                                                    value="{{ old('alamat') }}" required></textarea>
                                                @error('alamat')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="country-floating">Desa</label>
                                                <input type="text" id="desa"
                                                    class="form-control @error('desa') is-invalid @enderror" name="desa"
                                                    placeholder="Desa" value="{{ old('desa') }}" required>
                                                @error('desa')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="company-column">Kecamatan</label>
                                                <input type="text" id="kecamatan"
                                                    class="form-control @error('kecamatan') is-invalid @enderror"
                                                    name="kecamatan" placeholder="Kecamatan" value="{{ old('kecamatan') }}"
                                                    required>
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
                                                        <option value="{{ $w->rw }}">
                                                            RW {{ $w->rw }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>RT</label>

                                                <select id="rt" name="wilayah_id" class="form-control" disabled>

                                                    <option value="">Pilih RT</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status"
                                                    class="form-control @error('status') is-invalid @enderror">
                                                    <option value="active">Aktif</option>
                                                    <option value="moved">Pindah</option>
                                                    <option value="deceased">Meninggal</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <a href="/resident" class="btn btn-outline-secondary me-1 mb-1">Kembali</a>
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
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

        rwSelect.addEventListener('change', function() {

            const selectedRw = this.value;

            // reset dropdown RT
            rtSelect.innerHTML = '<option value="">Pilih RT</option>';

            // jika RW belum dipilih
            if (!selectedRw) {
                rtSelect.disabled = true;
                return;
            }

            // aktifkan dropdown RT
            rtSelect.disabled = false;

            // filter RT berdasarkan RW
            const filteredRt = wilayah.filter(item => item.rw == selectedRw);

            // tampilkan RT
            filteredRt.forEach(item => {

                rtSelect.innerHTML += `
                <option value="${item.id}">
                    RT ${item.rt}
                </option>
            `;
            });
        });
    </script>
@endsection
