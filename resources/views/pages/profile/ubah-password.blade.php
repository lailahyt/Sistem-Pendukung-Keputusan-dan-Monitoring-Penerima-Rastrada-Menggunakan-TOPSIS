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
        <div class="row ">
            <div class="col-12 ">
                <div class="card">
                    {{-- <div class="card-header">
                        <h5 class="card-title mb-0">Ubah Password</h5>
                    </div> --}}
                    <div class="card-body">

                        <div class="text-center mb-4">
                            <div class="avatar avatar-xl bg-warning bg-opacity-10 mb-3">
                                <span class="avatar-content">
                                    <i class="bi bi-shield-lock fs-2 text-warning"></i>
                                </span>
                            </div>

                            <h5 class="mb-1">Keamanan Akun</h5>
                            <p class="text-muted small">
                                Pastikan password baru mudah diingat dan aman digunakan.
                            </p>
                        </div>

                        @if(session('success_password'))
                            <div class="alert alert-success">
                                {{ session('success_password') }}
                            </div>
                        @endif

                        @if(session('error_password'))
                            <div class="alert alert-danger">
                                {{ session('error_password') }}
                            </div>
                        @endif

                        <form action="/profile/update-password" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Password Lama</label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>

                                    <input type="password"
                                        name="current_password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        placeholder="Masukkan password lama"
                                        required>
                                </div>

                                @error('current_password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password Baru</label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-key"></i>
                                    </span>

                                    <input type="password"
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Masukkan password baru"
                                        required>
                                </div>

                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Konfirmasi Password Baru</label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-check-circle"></i>
                                    </span>

                                    <input type="password"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Ulangi password baru"
                                        required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">

                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-shield-lock"></i>
                                    Simpan Password Baru
                                </button>

                                {{-- <a href="/profile" class="btn btn-light-secondary">
                                    <i class="bi bi-arrow-left"></i>
                                    Kembali ke Profile
                                </a> --}}

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
