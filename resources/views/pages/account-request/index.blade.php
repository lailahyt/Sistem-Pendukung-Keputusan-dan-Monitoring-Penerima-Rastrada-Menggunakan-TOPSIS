@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Akun</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Permintaan Akun</li>
                    </ol>
                </nav>

                <!-- Tombol di bawah breadcrumb -->
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
            <div class="card-header">
                <h5 class="card-title">
                    Data Akun
                </h5>
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
                    @if (count($users) < 1)
                    <tbody>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data akun</td>
                        </tr>
                    </tbody>
                    @else

                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <th>
                                <div class="d-flex "style="gap: 5px;">
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationReject{{ $item->id }}">
                                        Tolak
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationApprove{{ $item->id }}">
                                        Setuju
                                    </button>
                                </div>
                            </th>

                        </tr>
                        @include('pages.account-request.confirmation-approve')
                        @include('pages.account-request.confirmation-reject')
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
