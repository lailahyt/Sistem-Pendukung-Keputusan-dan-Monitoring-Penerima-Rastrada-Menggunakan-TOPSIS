```php
@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Akun Pengguna</h3>
                    <p></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Akun</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Input Akun</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('account.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            {{-- Nama --}}
                            <div class="col-md-6 mb-3">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan nama"
                                    required>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                                    required>
                            </div>

                            {{-- Password --}}
                            <div class="col-md-6 mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                                    required>
                            </div>

                            {{-- Role --}}
                            <div class="col-md-6 mb-3">
                                <label>Role</label>
                                <select name="role_id" id="role_id" class="form-control" required>
                                    <option value="">-- Pilih Role --</option>

                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        {{-- SECTION PETUGAS / LURAH --}}
                        <div id="pegawai-section" style="display:none;">
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <label>Pilih Pegawai</label>

                                    <select name="pegawai_id" id="pegawai_id" class="form-control">

                                        <option value="">
                                            -- Pilih Pegawai --
                                        </option>

                                    </select>
                                </div>

                            </div>
                        </div>

                        {{-- SECTION RT RW --}}
                        <div id="rtrw-section" style="display:none;">
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label>RT</label>

                                    <select name="rt" id="rt" class="form-control">

                                        <option value="">-- Pilih RT --</option>

                                        @foreach ($wilayah as $item)
                                            <option value="{{ $item->rt }}" data-rw="{{ $item->rw }}">
                                                {{ $item->rt }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>RW</label>

                                    <input type="text" name="rw" id="rw" class="form-control" readonly>
                                </div>

                            </div>
                        </div>

                        <div class="mt-3 d-flex justify-content-end gap-2">
                            <a href="/account-list" class="btn btn-outline-secondary me-1 mb-1">
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

    {{-- DATA PEGAWAI PETUGAS --}}
    <script>
        const pegawaiPetugas = @json($pegawaiPetugas);

        const pegawaiLurah = @json($pegawaiLurah);

        const roleSelect = document.getElementById('role_id');

        const pegawaiSection = document.getElementById('pegawai-section');

        const rtrwSection = document.getElementById('rtrw-section');

        const pegawaiSelect = document.getElementById('pegawai_id');

        roleSelect.addEventListener('change', function() {

            const roleName =
                this.options[this.selectedIndex].text.trim();

            pegawaiSection.style.display = 'none';
            rtrwSection.style.display = 'none';

            pegawaiSelect.innerHTML =
                '<option value="">-- Pilih Pegawai --</option>';

            if (roleName === 'Petugas') {

                pegawaiSection.style.display = 'block';

                pegawaiPetugas.forEach(item => {

                    pegawaiSelect.innerHTML += `
                    <option value="${item.id}">
                        ${item.nama}
                    </option>
                `;

                });

            } else if (roleName === 'Lurah') {

                pegawaiSection.style.display = 'block';

                pegawaiLurah.forEach(item => {

                    pegawaiSelect.innerHTML += `
                    <option value="${item.id}">
                        ${item.nama}
                    </option>
                `;

                });

            } else if (roleName === 'RT/RW') {

                rtrwSection.style.display = 'block';

            }
        });

        document.getElementById('rt').addEventListener('change', function() {

            const selectedOption =
                this.options[this.selectedIndex];

            const rw =
                selectedOption.getAttribute('data-rw');

            document.getElementById('rw').value =
                rw ?? '';

        });
    </script>
@endsection
