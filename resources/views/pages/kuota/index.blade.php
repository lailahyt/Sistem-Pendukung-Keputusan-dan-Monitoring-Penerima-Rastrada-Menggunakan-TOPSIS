@extends('layouts.app')

@section('content')
    <div class="page-heading">

        <div class="page-title">
            <div class="row">

                <div class="col-12 col-md-6">
                    <h3>Kuota Penerima</h3>
                    <p>Input kuota dari Dinas Sosial</p>
                </div>

            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <section class="section">

            <div class="card">

                <div class="card-header">
                    <h5 class="card-title">
                        Data Kuota Periode
                    </h5>
                </div>

                <div class="card-body">

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Periode</th>
                                <th>Tahun</th>
                                <th>Kuota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($periode as $item)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $item->nama_periode }}</td>

                                    <td>{{ $item->tahun }}</td>

                                    <td width="250">

                                        <form action="{{ route('kuota.update', $item->id) }}" method="POST">

                                            @csrf
                                            @method('PUT')

                                            <input type="number" name="kuota" class="form-control" min="0"
                                                value="{{ $item->kuota ?? 0 }}">

                                    </td>

                                    <td width="150">

                                        <button class="btn btn-primary btn-sm">

                                            Simpan

                                        </button>

                                        </form>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>

        </section>

    </div>
@endsection
