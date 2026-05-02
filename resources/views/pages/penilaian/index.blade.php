@extends('layouts.app')
@section('content')
    <div class="page-heading">

        <!-- HEADER -->
        <div class="page-title">
            <div class="row">

                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Penilaian</h3>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Penilaian</li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <section class="section">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title">Data Calon Penerima</h5>
                </div>

                <div class="card-body">

                    <table class="table table-striped table-responsive" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Calon Penerima</th>
                                <th>Kelengkapan</th>
                                <th>Nilai Rata-rata</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        @if (count($penduduk) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Tidak ada data penilaian
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($penduduk as $item)
                                    @php
                                        // total kriteria
                                        $total = count($kriteria);

                                        // jumlah yang sudah dinilai
                                        $terisi = $item->penilaian_detail_count ?? 0;

                                        // status
                                        if ($terisi == 0) {
                                            $status = 'Belum';
                                            $badge = 'secondary';
                                        } elseif ($terisi < $total) {
                                            $status = 'Proses';
                                            $badge = 'warning';
                                        } else {
                                            $status = 'Selesai';
                                            $badge = 'success';
                                        }
                                    @endphp

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <!-- Nama -->
                                        <td>
                                            <strong>{{ $item->nama }}</strong><br>
                                            <small>Desa: {{ $item->desa }}</small>
                                        </td>

                                        <!-- Kelengkapan -->
                                        <td>
                                            {{ $terisi }}/{{ $total }}
                                        </td>

                                        <!-- Nilai rata-rata -->
                                        <td>
                                            {{ $item->rata_rata ?? '-' }}
                                        </td>

                                        <!-- Status -->
                                        <td>
                                            <span class="badge bg-{{ $badge }}">
                                                {{ $status }}
                                            </span>
                                        </td>

                                        <!-- Aksi -->
                                        <td>
                                            <a href="/penilaian/{{ $item->id }}" class="btn btn-primary btn-sm">
                                                Nilai
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif

                    </table>

                </div>
            </div>
        </section>
    </div>
@endsection
