@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <h3>Edit Data Penilaian</h3>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Edit Penilaian</h5>
                </div>

                <div class="card-body">
                    <form action="/penilaian/{{ $penduduk->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="periode_id" value="{{ $periode_id }}">

                        {{-- Informasi Penduduk --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Penduduk</label>
                                <input type="text" class="form-control" value="{{ $penduduk->nama }}" readonly>
                            </div>
                        </div>

                        <hr>

                        @foreach ($kriteria as $k)
                            <div class="row mb-4 p-3 border rounded">

                                <div class="col-md-12 mb-2">
                                    <strong>{{ $k->nama_kriteria }}</strong>
                                </div>

                                {{-- Subkriteria --}}
                                <div class="col-md-4 mb-2">
                                    <label>Sub Kriteria</label>
                                    <select name="subkriteria[{{ $k->id }}]" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($k->subkriteria as $sub)
                                            <option value="{{ $sub->id }}"
                                                {{ ($detail[$k->id]['subkriteria_id'] ?? '') == $sub->id ? 'selected' : '' }}>
                                                {{ $sub->label_subkriteria }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @if ($k->butuh_bukti)
                                    {{-- Upload Bukti --}}
                                    <div class="col-md-4 mb-2">
                                        <label>Upload Bukti</label>
                                        <input type="file" name="bukti[{{ $k->id }}]" class="form-control"
                                            accept="image/*,.pdf" capture="environment">
                                    </div>

                                    {{-- Bukti Lama --}}
                                    <div class="col-md-4 mb-2">
                                        <label>Bukti Lama</label><br>

                                        @if (!empty($detail[$k->id]['bukti_file']))
                                            <a href="{{ asset('storage/' . $detail[$k->id]['bukti_file']) }}"
                                                target="_blank" class="btn btn-sm btn-info">
                                                Lihat
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </div>
                                @endif

                                {{-- Catatan --}}
                                <div class="col-md-12 mt-2">
                                    <label>Catatan</label>
                                    <textarea name="catatan[{{ $k->id }}]" class="form-control" rows="2">{{ $detail[$k->id]['catatan'] ?? '' }}</textarea>
                                </div>

                            </div>
                        @endforeach

                        {{-- Tombol --}}
                        <div class="mt-3 d-flex justify-content-end gap-2">
                            <a href="/penilaian?periode_id={{ $periode_id }}"
                                class="btn btn-outline-secondary me-1 mb-1">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
