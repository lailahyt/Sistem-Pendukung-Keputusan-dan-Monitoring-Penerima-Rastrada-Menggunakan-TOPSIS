@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Permintaan Akun</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Permintaan Akun</li>
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
                    <h5 class="card-title mb-0">Data Permintaan Akun</h5>
                    <small class="text-muted">Total {{ $users->count() }} permintaan menunggu</small>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
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
                                <div class="d-flex" style="gap:6px">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmationReject{{ $item->id }}">
                                        <i class="bi bi-x-lg"></i> Tolak
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmationApprove{{ $item->id }}">
                                        <i class="bi bi-check-lg"></i> Setuju
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('pages.account-request.confirmation-approve', ['user' => $item])
                        @include('pages.account-request.confirmation-reject', ['user' => $item])
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-5 d-block mb-1"></i>
                                Tidak ada permintaan akun
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
