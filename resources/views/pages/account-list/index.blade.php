@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Akun</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Akun</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            title: "Berhasil",
            text: "{{ session()->get('success') }}",
            icon: "success"
        });
    </script>
    @endif

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">Data Akun</h5>
                    <small class="text-muted">Total {{ $users->count() }} akun petugas terdaftar</small>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if($item->status == 'approved')
                                    <span class="badge bg-light-success">Aktif</span>
                                @else
                                    <span class="badge bg-light-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex" style="gap:6px">
                                    @if($item->status == 'approved')
                                        <button type="button"
                                            class="btn btn-outline-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmationReject{{ $item->id }}">
                                            <i class="bi bi-person-slash"></i> Non Aktifkan
                                        </button>
                                    @else
                                        <button type="button"
                                            class="btn btn-outline-success btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmationApprove{{ $item->id }}">
                                            <i class="bi bi-person-check"></i> Aktifkan
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @include('pages.account-list.confirmation-approve', ['user' => $item])
                        @include('pages.account-list.confirmation-reject', ['user' => $item])
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-5 d-block mb-1"></i>
                                Tidak ada data akun
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
