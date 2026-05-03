@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <h3>Penilaian</h3>
        <p>{{ $penduduk->nama }}</p>

        <form action="/penilaian/store" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="penduduk_id" value="{{ $penduduk->id }}">
            <input type="hidden" name="periode" value="{{ date('Y') }}">
            @foreach ($kriteria as $k)
                <div class="card mb-3">
                    <div class="card-body">
                        <label><strong>{{ $k->nama_kriteria }}</strong></label>

                        <select name="subkriteria[{{ $k->id }}]" class="form-control">
                            <option value="">-- Pilih --</option>
                            @foreach ($k->subkriteria as $sub)
                                <option value="{{ $sub->id }}">
                                    {{ $sub->label_subkriteria }} ({{ $sub->nilai }})
                                </option>
                            @endforeach
                        </select>

                        <div class="mt-2">
                            <label>Bukti (foto/file)</label>
                            <input type="file" name="bukti[{{ $k->id }}]" class="form-control">
                        </div>
                        <div class="mt-2">
                            <label>Catatan</label>
                            <textarea name="catatan[{{ $k->id }}]" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/penilaian" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
