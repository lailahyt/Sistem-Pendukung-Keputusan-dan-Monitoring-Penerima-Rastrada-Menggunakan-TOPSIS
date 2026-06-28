@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Ubah Password</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/profile">My Profile</a></li>
                        <li class="breadcrumb-item active">Ubah Password</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-shield-lock text-warning me-2"></i>Ubah Password
                        </h5>
                    </div>
                    <div class="card-body">

                        @if(session('success_password'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ session('success_password') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error_password'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                {{ session('error_password') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="/profile/update-password" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Password Lama --}}
                            <div class="mb-3">
                                <label class="form-label">Password Lama</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password"
                                        id="currentPassword"
                                        name="current_password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        placeholder="Masukkan password lama"
                                        required>
                                    <button type="button"
                                        class="input-group-text bg-transparent"
                                        onclick="togglePw('currentPassword', 'eyeOld')"
                                        title="Tampilkan password">
                                        <i id="eyeOld" class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password Baru --}}
                            <div class="mb-3">
                                <label class="form-label">Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-key"></i>
                                    </span>
                                    <input type="password"
                                        id="newPassword"
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Masukkan password baru"
                                        required
                                        oninput="recheckConfirm()">
                                    <button type="button"
                                        class="input-group-text bg-transparent"
                                        onclick="togglePw('newPassword', 'eyeNew')"
                                        title="Tampilkan password">
                                        <i id="eyeNew" class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="mb-4">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-check-circle"></i>
                                    </span>
                                    <input type="password"
                                        id="confirmPassword"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Ulangi password baru"
                                        required
                                        oninput="checkConfirm(this.value)">
                                    <button type="button"
                                        class="input-group-text bg-transparent"
                                        onclick="togglePw('confirmPassword', 'eyeConfirm')"
                                        title="Tampilkan password">
                                        <i id="eyeConfirm" class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <small id="confirmMsg" class="mt-1 d-block"></small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="/profile" class="text-muted small">
                                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Profil
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-shield-lock me-1"></i>Simpan Password Baru
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
    function togglePw(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type    = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type    = 'password';
            icon.className = 'bi bi-eye';
        }
    }

    function checkConfirm(val) {
        const newPw = document.getElementById('newPassword').value;
        const input = document.getElementById('confirmPassword');
        const msg   = document.getElementById('confirmMsg');

        if (!val) { msg.textContent = ''; input.setCustomValidity(''); return; }

        if (val === newPw) {
            msg.textContent = '✓ Password cocok';
            msg.style.color = '#22c55e';
            input.setCustomValidity('');
        } else {
            msg.textContent = 'Password tidak cocok';
            msg.style.color = '#ef4444';
            input.setCustomValidity('Password tidak cocok.');
        }
    }

    function recheckConfirm() {
        const confirm = document.getElementById('confirmPassword');
        if (confirm.value) checkConfirm(confirm.value);
    }
</script>
@endsection
