@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <h3>Edit Data Pegawai</h3>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Edit Pegawai</h5>
                </div>

                <div class="card-body">
                    <form action="/employee/{{ $pegawai->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>ID</label>
                                <input type="text" class="form-control" value="{{ $pegawai->id }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Nama Pegawai</label>
                                <input type="text" name="nama" class="form-control" value="{{ $pegawai->nama }}"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>NIP</label>
                                <input type="text" name="nip" class="form-control" value="{{ $pegawai->nip }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Jabatan</label>
                                <select name="jabatan" class="form-control" required>
                                    <option value="Pegawai" {{ $pegawai->jabatan == 'Pegawai' ? 'selected' : '' }}>
                                        Pegawai
                                    </option>
                                    <option value="Lurah" {{ $pegawai->jabatan == 'Lurah' ? 'selected' : '' }}>
                                        Lurah
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>No HP</label>
                                <input type="text" name="no_hp" class="form-control"
                                    value="{{ old('no_hp', $pegawai->no_hp) }}" maxlength="13" minlength="10"
                                    pattern="[0-9]{10,13}" inputmode="numeric" placeholder="Contoh: 081234567890">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3">{{ $pegawai->alamat }}</textarea>
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
