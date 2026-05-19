@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>My Profile</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-md-4 mb-4">

                {{-- Card Info --}}
                <div class="card text-center">
                    <div class="card-body py-4">
                        <div class="d-flex justify-content-center mb-3">
                            <div style="width:80px;height:80px;border-radius:50%;
                                background:#435ebe;display:flex;align-items:center;
                                justify-content:center;font-size:32px;
                                font-weight:500;color:#fff;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </div>
                        <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                        <p class="text-muted mb-2" style="font-size:13px">
                            {{ auth()->user()->email }}
                        </p>
                        <div class="mt-3 text-muted small">

                            <div class="mb-1">
                                <i class="bi bi-person-badge"></i>
                                Role:
                                {{ auth()->user()->role->name ?? '-' }}
                            </div>

                            <div>
                                <i class="bi bi-shield-check"></i>
                                Status:
                                {{ auth()->user()->status }}
                            </div>

                        </div>
                        {{-- <span class="badge bg-light-primary">
                            {{ auth()->user()->role ?? 'Admin' }}
                        </span> --}}
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-8">

                {{-- Form Edit Profile --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Edit Profile</h5>
                    </div>
                    <div class="card-body">

                        @if(session('success_profile'))
                            <div class="alert alert-success">
                                {{ session('success_profile') }}
                            </div>
                        @endif

                        <form action="/profile/update" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', auth()->user()->name) }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Simpan Perubahan
                                </button>
                                {{-- <a href="/profile/ubah-password" class="btn btn-outline-warning">
                                    <i class="bi bi-key"></i> Ubah Password
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
