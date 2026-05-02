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

                                            <button class="btn btn-info btn-sm btn-detail" data-id="{{ $item->id }}"
                                                data-nama="{{ $item->nama }}">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif

                    </table>

                    <div class="modal fade" id="modalDetail" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Penilaian</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <h6 id="namaPenduduk"></h6>

                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                <th>Subkriteria</th>
                                                <th>Nilai</th>
                                                <th>Bukti</th>
                                                <th>Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="detailBody">
                                            <tr>
                                                <td colspan="5" class="text-center">Loading...</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
