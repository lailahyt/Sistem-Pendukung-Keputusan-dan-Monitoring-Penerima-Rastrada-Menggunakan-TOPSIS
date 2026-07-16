@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Penduduk</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Penduduk</li>
                        </ol>
                    </nav>
                    <div class="text-md-end mt-2 mb-3">
                        <a href="/resident/create" class="btn btn-sm btn-primary shadow-sm">
                            <i class="bi bi-plus"></i> Tambah Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Data Penduduk</h5>
                        <small class="text-muted">Total {{ $residents->count() }} penduduk terdaftar</small>
                    </div>
                </div>
                <div class="card-body">

                    {{-- Filter --}}
                    @if (auth()->user()->role_id != 4)
                        <form method="GET" action="/resident">
                            <div class="row mb-3 g-2 align-items-end">

                                <div class="col-md-3">
                                    <label class="form-label mb-1" style="font-size:13px">RW</label>
                                    <select name="rw" id="selectRW" class="form-select form-select-sm">
                                        <option value="">Semua RW</option>
                                        @foreach ($wilayah->unique('rw') as $w)
                                            <option value="{{ $w->rw }}"
                                                {{ request('rw') == $w->rw ? 'selected' : '' }}>
                                                RW {{ $w->rw }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label mb-1" style="font-size:13px">RT</label>
                                    <select name="rt" id="selectRT" class="form-select form-select-sm">
                                        <option value="">Semua RT</option>
                                        @foreach ($wilayah as $w)
                                            <option value="{{ $w->rt }}"
                                                {{ request('rt') == $w->rt ? 'selected' : '' }}>
                                                RT {{ $w->rt }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-sm btn-primary w-100">
                                        <i class="bi bi-search"></i> Filter
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <a href="/resident" class="btn btn-sm btn-secondary w-100">
                                        <i class="bi bi-x"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    @endif

                    <table class="table table-striped table-responsive" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Usia</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Desa</th>
                                <th>Kecamatan</th>
                                <th>RW/RT</th>
                                <th>Status</th>
                                <th>Status Pengajuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($residents as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->usia }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->desa }}</td>
                                    <td>{{ $item->kecamatan }}</td>
                                    <td>
                                        RW {{ $item->wilayah->rw ?? '-' }} /
                                        RT {{ $item->wilayah->rt ?? '-' }}
                                    </td>
                                    <td>

                                        @if ($item->status == 'active')
                                            <span class="badge bg-success">
                                                Aktif
                                            </span>
                                        @elseif($item->status == 'moved')
                                            <span class="badge bg-warning text-dark">
                                                Pindah
                                            </span>
                                        @elseif($item->status == 'deceased')
                                            <span class="badge bg-danger">
                                                Meninggal
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Tidak Diketahui
                                            </span>
                                        @endif

                                    </td>
                                    <td>

                                        @if ($item->status_pengajuan == 'diajukan')
                                            <span class="badge bg-primary">
                                                Diajukan
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Belum Diajukan
                                            </span>
                                        @endif

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center" style="gap:8px">
                                            <a href="/resident/{{ $item->id }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit text-white"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#confirmationDelete{{ $item->id }}">
                                                <i class="fas fa-eraser"></i>
                                            </button>
                                            @if (auth()->user()->role_id == 4)
                                                @if ($item->status == 'active' && $item->status_pengajuan == 'belum_diajukan')
                                                    <form action="/resident/{{ $item->id }}/ajukan" method="POST"
                                                        style="display:inline;">
                                                        @csrf

                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="bi bi-send-check"></i>
                                                        </button>
                                                    </form>
                                                @elseif($item->status_pengajuan == 'diajukan')
                                                    <span class="badge bg-primary">
                                                        Diajukan
                                                    </span>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @include('pages.resident.delete', ['resident' => $item])
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-5 d-block mb-1"></i>
                                        Tidak ada data penduduk
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script>
        const rtPerRw = {
            '1': ['1', '2'],
            '2': ['3', '4'],
            '3': ['5', '6'],
            '4': ['7', '8'],
            '5': ['9', '10', '11']
        };

        function populateRT(rw, selectedRT = '') {
            const selectRT = document.getElementById('selectRT');
            selectRT.innerHTML = '<option value="">Semua RT</option>';

            const rtList = rw ? rtPerRw[rw] : Object.values(rtPerRw).flat();
            rtList.forEach(rt => {
                const selected = selectedRT == rt ? 'selected' : '';
                selectRT.innerHTML += `<option value="${rt}" ${selected}>RT ${rt}</option>`;
            });
        }

        document.getElementById('selectRW').addEventListener('change', function() {
            populateRT(this.value);
        });

        // Trigger saat load kalau ada filter aktif
        window.addEventListener('load', function() {
            const rwVal = "{{ request('rw') }}";
            const rtVal = "{{ request('rt') }}";
            if (rwVal) {
                document.getElementById('selectRW').value = rwVal;
                populateRT(rwVal, rtVal);
            }
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Berhasil",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonColor: "#198754",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Gagal",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonColor: "#dc3545",
                    confirmButtonText: "Tutup"
                });
            });
        </script>
    @endif

    @if (session('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Peringatan",
                    text: "{{ session('warning') }}",
                    icon: "warning",
                    confirmButtonColor: "#f59e0b",
                    confirmButtonText: "Mengerti"
                });
            });
        </script>
    @endif
@endsection
