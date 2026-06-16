@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Perhitungan TOPSIS</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Proses</li>
                            <li class="breadcrumb-item active">TOPSIS</li>
                        </ol>
                    </nav>

                    <div class="text-md-end mt-2 mb-3">
                        <form method="GET">
                            <div class="d-flex justify-content-end align-items-center gap-2">
                                <label class="text-muted mb-0" style="font-size:13px;white-space:nowrap">
                                    Pilih Periode:
                                </label>
                                <select name="periode_id" class="form-select form-select-sm" style="width:200px"
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

        {{-- Navigasi Antar Section --}}
        <div class="d-flex gap-2 flex-wrap mb-3">
            <a href="#matriks" class="btn btn-sm btn-outline-secondary">Matriks Keputusan</a>
            <a href="#normalisasi" class="btn btn-sm btn-outline-secondary">Normalisasi</a>
            <a href="#terbobot" class="btn btn-sm btn-outline-secondary">Terbobot</a>
            <a href="#ideal" class="btn btn-sm btn-outline-secondary">Solusi Ideal</a>
            <a href="#jarak" class="btn btn-sm btn-outline-secondary">Jarak</a>
            <a href="#preferensi" class="btn btn-sm btn-outline-secondary">Preferensi</a>
            <a href="#ranking" class="btn btn-sm btn-outline-secondary">Ranking</a>
        </div>

        @if (isset($message))
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle me-1"></i>
                {{ $message }}
            </div>
        @else
            {{-- 1. Matriks Keputusan --}}
            <section class="section" id="matriks">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">1. Matriks Keputusan</h5>
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
                                                <small class="text-muted">{{ $k->nama_kriteria }}</small>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($matriksPaginate as $row)
                                        <tr>
                                            <td>{{ $matriksPaginate->firstItem() + $loop->index }}</td>
                                            <td>{{ $row['nama'] }}</td>
                                            @foreach ($row['data'] as $nilai)
                                                <td>{{ $nilai == 0 ? '-' : $nilai }}</td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($kriteria) + 2 }}" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox fs-5 d-block mb-1"></i>
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            {{ $matriksPaginate->links() }}
                        </div>
                    </div>
                </div>
            </section>

            {{-- 2. Normalisasi --}}
            <section class="section" id="normalisasi">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">2. Hasil Normalisasi</h5>
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
                                                <small class="text-muted">{{ $k->nama_kriteria }}</small>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($normalisasiPaginate as $i => $row)
                                        <tr>
                                            <td>{{ $normalisasiPaginate->firstItem() + $loop->index }}</td>
                                            <td>{{ $row['nama'] }}</td>
                                            @foreach ($row['data'] as $nilai)
                                                <td>{{ number_format($nilai, 4) }}</td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($kriteria) + 2 }}" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox fs-5 d-block mb-1"></i>
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            {{ $normalisasiPaginate->links() }}
                        </div>
                    </div>
                </div>
            </section>

            {{-- 3. Normalisasi Terbobot --}}
            <section class="section" id="terbobot">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">3. Matriks Normalisasi Terbobot</h5>
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
                                                <small class="text-muted">{{ $k->nama_kriteria }}</small>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($terbobotPaginate as $i => $row)
                                        <tr>
                                            <td>{{ $terbobotPaginate->firstItem() + $loop->index }}</td>
                                            <td>{{ $row['nama'] }}</td>

                                            @foreach ($row['data'] as $nilai)
                                                <td>{{ number_format($nilai, 4) }}</td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($kriteria) + 2 }}" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox fs-5 d-block mb-1"></i>
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            {{ $terbobotPaginate->links() }}
                        </div>
                    </div>
                </div>
            </section>

            {{-- 4. Solusi Ideal --}}
            <section class="section" id="ideal">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">4. Solusi Ideal Positif dan Negatif</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Solusi</th>
                                        @foreach ($kriteria as $k)
                                            <th>
                                                {{ $k->kode }}<br>
                                                <small class="text-muted">{{ $k->nama_kriteria }}</small>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="badge bg-success">A+</span>
                                            <small class="text-muted ms-1">Ideal Positif</small>
                                        </td>
                                        @foreach ($kriteria as $k)
                                            <td>{{ number_format($idealPositif[$k->id], 4) }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="badge bg-danger">A-</span>
                                            <small class="text-muted ms-1">Ideal Negatif</small>
                                        </td>
                                        @foreach ($kriteria as $k)
                                            <td>{{ number_format($idealNegatif[$k->id], 4) }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 5. Jarak Solusi Ideal --}}
            <section class="section" id="jarak">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">5. Jarak Solusi Ideal</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Alternatif</th>
                                        <th>D+ <small class="text-muted">(Jarak Positif)</small></th>
                                        <th>D- <small class="text-muted">(Jarak Negatif)</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jarakPaginate as $row)
                                        <tr>
                                            <td>{{ $jarakPaginate->firstItem() + $loop->index }}</td>
                                            <td>{{ $row['nama'] }}</td>
                                            <td>{{ number_format($row['positif'], 4) }}</td>
                                            <td>{{ number_format($row['negatif'], 4) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox fs-5 d-block mb-1"></i>
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            {{ $jarakPaginate->links() }}
                        </div>
                    </div>
                </div>
            </section>

            {{-- 6. Nilai Preferensi --}}
            <section class="section" id="preferensi">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">6. Nilai Preferensi</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Alternatif</th>
                                        <th>Nilai Preferensi (Vi)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($preferensiPaginate as $row)
                                        <tr>
                                            <td>{{ $preferensiPaginate->firstItem() + $loop->index }}</td>
                                            <td>{{ $row['nama'] }}</td>
                                            <td>{{ number_format($row['nilai'], 4) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox fs-5 d-block mb-1"></i>
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            {{ $preferensiPaginate->links() }}
                        </div>
                    </div>
                </div>
            </section>

            {{-- 7. Ranking --}}
            <section class="section" id="ranking">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">7. Ranking Hasil TOPSIS</h5>
                        {{-- <a href="/topsis/simpan?periode_id={{ $periode_id }}"
                    class="btn btn-sm btn-primary">
                    <i class="bi bi-save"></i> Simpan Hasil
                </a> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Nama Alternatif</th>
                                        <th>Nilai Preferensi (Vi)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($rankingPaginate as $row)
                                        <tr>
                                            <td>
                                                @if ($row['rank'] == 1)
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-trophy-fill"></i> #1
                                                    </span>
                                                @elseif($row['rank'] == 2)
                                                    <span class="badge bg-secondary">#2</span>
                                                @elseif($row['rank'] == 3)
                                                    <span class="badge" style="background:#cd7f32">#3</span>
                                                @else
                                                    <span class="badge bg-light text-dark border">
                                                        #{{ $row['rank'] }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $row['nama'] }}</td>
                                            <td>{{ number_format($row['nilai'], 4) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox fs-5 d-block mb-1"></i>
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            {{ $rankingPaginate->links() }}
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
