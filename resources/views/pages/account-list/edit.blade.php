@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <h3>Edit Akun Pengguna</h3>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Edit Akun</h5>
                </div>

                <div class="card-body">

                    <form action="/account-list/{{ $user->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            {{-- Nama --}}
                            <div class="col-md-6 mb-3">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            {{-- Password --}}
                            <div class="col-md-6 mb-3">
                                <label>Password Baru</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Kosongkan jika tidak diubah">
                            </div>

                            {{-- Role --}}
                            <div class="col-md-6 mb-3">
                                <label>Role</label>

                                <select name="role_id" id="role_id" class="form-control" required>

                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        {{-- PEGAWAI --}}
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

                        {{-- RT RW --}}
                        <div id="rtrw-section" style="display:none;">
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label>RT</label>

                                    <select name="rt" id="rt" class="form-control">

                                        <option value="">
                                            -- Pilih RT --
                                        </option>

                                        @foreach ($wilayah as $item)
                                            <option value="{{ $item->rt }}" data-rw="{{ $item->rw }}"
                                                {{ $user->rt == $item->rt ? 'selected' : '' }}>
                                                RT {{ $item->rt }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>RW</label>

                                    <input type="text" name="rw" id="rw" class="form-control"
                                        value="{{ old('rw', $user->rw) }}" readonly>
                                </div>

                            </div>
                        </div>

                        <div class="mt-3 d-flex justify-content-end gap-2">
                            <a href="/account-list" class="btn btn-outline-secondary me-1 mb-1">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </div>

    <script>
        const pegawaiPetugas = @json($pegawaiPetugas);
        const pegawaiLurah = @json($pegawaiLurah);

        const roleSelect = document.getElementById('role_id');
        const pegawaiSection = document.getElementById('pegawai-section');
        const rtrwSection = document.getElementById('rtrw-section');
        const pegawaiSelect = document.getElementById('pegawai_id');

        function loadRoleForm() {

            const roleId = roleSelect.value;

            pegawaiSection.style.display = 'none';
            rtrwSection.style.display = 'none';

            pegawaiSelect.innerHTML =
                '<option value="">-- Pilih Pegawai --</option>';

            if (roleId == 2) {

                pegawaiSection.style.display = 'block';

                pegawaiPetugas.forEach(item => {

                    pegawaiSelect.innerHTML += `
                <option value="${item.id}"
                    ${item.user_id == {{ $user->id }} ? 'selected' : ''}>
                    ${item.nama}
                </option>
            `;

                });

            }

            if (roleId == 3) {

                pegawaiSection.style.display = 'block';

                pegawaiLurah.forEach(item => {

                    pegawaiSelect.innerHTML += `
                <option value="${item.id}"
                    ${item.user_id == {{ $user->id }} ? 'selected' : ''}>
                    ${item.nama}
                </option>
            `;

                });

            }

            if (roleId == 4) {

                rtrwSection.style.display = 'block';

            }

        }

        roleSelect.addEventListener('change', loadRoleForm);

        loadRoleForm();

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
