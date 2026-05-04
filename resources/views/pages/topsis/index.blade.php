@extends('layouts.app')

@section('content')

    <div class="page-heading">

        <div class="page-title">
            <div class="row">

                <!-- Judul -->
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Perhitungan TOPSIS</h3>
                </div>

                <!-- Breadcrumb -->
                <div class="col-12 col-md-6 order-md-2 order-first">

                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Proses</li>
                            <li class="breadcrumb-item active">TOPSIS</li>
                        </ol>
                    </nav>

                    <!-- Dropdown Periode -->
                    <div class="text-md-end mt-2 mb-3">
                        <form method="GET">
                            <div class="d-flex justify-content-end gap-2">

                                <select name="periode_id" class="form-select" style="width: 220px;"
                                    onchange="this.form.submit()">

                                    @foreach ($periodeList as $p)
                                        <option value="{{ $p->id }}" {{ $periode_id == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama_periode }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- CARD -->
        <section class="section">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title">Matriks Keputusan</h5>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alternatif</th>
                                    @foreach ($kriteria as $k)
                                        <th>
                                            {{ $k->kode }}<br>
                                            <small>{{ $k->nama_kriteria }}</small>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($matriks as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row['nama'] }}</td>

                                        @foreach ($row['data'] as $nilai)
                                            <td>{{ $nilai == 0 ? '-' : $nilai }}</td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ count($kriteria) + 2 }}" class="text-center">
                                            Tidak ada data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>

                    </div>

                </div>
            </div>
        </section>

        <section class="section">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title">Hasil Normalisasi</h5>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alternatif</th>
                                    @foreach ($kriteria as $k)
                                        <th>
                                            {{ $k->kode }}<br>
                                            <small>{{ $k->nama_kriteria }}</small>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($normalisasi as $i => $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $matriks[$i]['nama'] }}</td>
                                        @foreach ($row as $nilai)
                                            <td>{{ number_format($nilai, 4) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection
