@extends('layouts.app')

@section('content')
    <div class="page-heading">

        <div class="page-title">
            <div class="row">

                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Hasil Rangking</h3>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header text-md-end">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>

                            <li class="breadcrumb-item active">
                                Hasil Rangking
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        <section class="section">

            <!-- SUMMARY -->
            <div class="row">

                <!-- Total -->
                <div class="col-6 col-md-3">
                    <div class="card">

                        <div class="card-body px-3 py-3">

                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-md bg-light-primary me-3">
                                    <i class="bi bi-people fs-4 text-primary"></i>
                                </div>

                                <div>
                                    <p class="mb-0 text-muted" style="font-size:12px">
                                        Total Alternatif
                                    </p>

                                    <h5 class="mb-0 fw-bold">
                                        {{ $totalAlternatif }}
                                    </h5>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Direkomendasikan -->
                <div class="col-6 col-md-3">
                    <div class="card">

                        <div class="card-body px-3 py-3">

                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-md bg-light-success me-3">
                                    <i class="bi bi-check-circle fs-4 text-success"></i>
                                </div>

                                <div>
                                    <p class="mb-0 text-muted" style="font-size:12px">
                                        Total Ditetapkan
                                    </p>

                                    <h5 class="mb-0 fw-bold text-success">
                                        {{ $totalDitetapkan }}
                                    </h5>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Tidak Direkomendasikan -->
                <div class="col-6 col-md-3">
                    <div class="card">

                        <div class="card-body px-3 py-3">

                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-md bg-light-danger me-3">
                                    <i class="bi bi-x-circle fs-4 text-danger"></i>
                                </div>

                                <div>
                                    <p class="mb-0 text-muted" style="font-size:12px">
                                        Belum Ditetapkan
                                    </p>

                                    <h5 class="mb-0 fw-bold text-danger">
                                        {{ $belumDitetapkan }}
                                    </h5>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Periode -->
                <div class="col-6 col-md-3">

                    <div class="card">

                        <div class="card-body px-3 py-3">

                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-md bg-light-warning me-4">
                                    <i class="bi bi-calendar fs-3 text-warning"></i>
                                </div>

                                <div class="w-100">

                                    <p class="mb-1 text-muted" style="font-size:12px">

                                        Periode
                                    </p>

                                    <form method="GET">

                                        <select name="periode_id" class="form-select form-select-sm"
                                            onchange="this.form.submit()">

                                            @foreach ($periodeList as $p)
                                                <option value="{{ $p->id }}"
                                                    {{ $periode_id == $p->id ? 'selected' : '' }}>

                                                    {{ $p->nama_periode }}

                                                </option>
                                            @endforeach

                                        </select>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- TABEL -->
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h5 class="card-title mb-0">
                        Ranking Hasil TOPSIS
                    </h5>

                    @if (auth()->user()->role->name != 'Lurah')
                        <div class="d-flex align-items-center gap-2">

                            <span class="badge bg-primary px-3 py-2">
                                Dipilih :
                                <span id="selectedCount">0</span>
                                data
                            </span>

                            <button type="submit" form="bulkForm" class="btn btn-success" id="btnBulk" disabled>
                                <i class="bi bi-check2-square"></i>
                                Tetapkan Terpilih

                            </button>

                        </div>
                    @endif

                </div>

                <div class="card-body">

                    @if (auth()->user()->role->name != 'Lurah')
                        <form id="bulkForm" action="{{ route('monitoring.tetapkan.bulk') }}" method="POST">

                            @csrf

                            <input type="hidden" name="periode_id" value="{{ $periode_id }}">

                        </form>
                    @endif

                    <div class="table-responsive">

                        <table class="table table-striped" id="table1">

                            <thead>
                                <tr>
                                    @if (auth()->user()->role->name != 'Lurah')
                                        <th width="50">
                                            <input type="checkbox" id="checkAll">
                                        </th>
                                    @endif
                                    <th>Rank</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Nilai Preferensi (Vi)</th>
                                    @if (auth()->user()->role->name != 'Lurah')
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($hasil as $row)
                                    <tr>
                                        @if (auth()->user()->role->name != 'Lurah')
                                            <td>
                                                @if (!in_array($row['id'], $ditetapkan))
                                                    <input type="checkbox" class="item-check" form="bulkForm"
                                                        name="selected[]" value="{{ $row['id'] }}">
                                                    <input type="hidden" form="bulkForm" name="ranks[{{ $row['id'] }}]"
                                                        value="{{ $row['rank'] }}">
                                                    <input type="hidden" form="bulkForm" name="nilai[{{ $row['id'] }}]"
                                                        value="{{ $row['nilai'] }}">
                                                @endif
                                            </td>
                                        @endif <!-- RANK -->
                                        <td>
                                            @if ($row['rank'] == 1)
                                                <span class="badge bg-warning text-dark"> <i class="bi bi-trophy-fill"></i>
                                                    {{ $row['rank'] }} </span>
                                            @elseif ($row['rank'] == 2)
                                                <span class="badge bg-secondary"> <i class="bi bi-award-fill"></i>
                                                    {{ $row['rank'] }} </span>
                                            @elseif ($row['rank'] == 3)
                                                <span class="badge" style="background:#cd7f32"> <i
                                                        class="bi bi-award-fill"></i> {{ $row['rank'] }} </span>
                                            @else
                                                <span class="badge bg-light text-dark border"> {{ $row['rank'] }}
                                                </span>
                                            @endif
                                        </td> <!-- NAMA -->
                                        <td class="fw-bold"> {{ $row['nama'] }} </td> <!-- NIK -->
                                        <td> {{ $row['nik'] }} </td> <!-- NILAI -->
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="progress w-100" style="height:6px">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ $row['nilai'] * 100 }}%"> </div>
                                                </div> <small class="text-bold" style="min-width:50px">
                                                    {{ number_format($row['nilai'], 3) }} </small>
                                            </div>
                                        </td> <!-- AKSI -->
                                        @if (auth()->user()->role->name != 'Lurah')
                                            <td>
                                                @if (in_array($row['id'], $ditetapkan))
                                                    <button class="btn btn-secondary btn-sm" disabled> <i
                                                            class="bi bi-check2-all"></i> Sudah Ditetapkan </button>
                                                @else
                                                    <form action="{{ route('monitoring.tetapkan') }}" method="POST">
                                                        @csrf <input type="hidden" name="penduduk_id"
                                                            value="{{ $row['id'] }}"> <input type="hidden"
                                                            name="periode_id" value="{{ $periode_id }}"> <input
                                                            type="hidden" name="rank" value="{{ $row['rank'] }}">
                                                        <input type="hidden" name="nilai"
                                                            value="{{ $row['nilai'] }}"> <button type="submit"
                                                            class="btn btn-success btn-sm"> <i
                                                                class="bi bi-check-circle"></i> Tetapkan </button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ auth()->user()->role->name != 'Lurah' ? 6 : 4 }}"
                                            class="text-center">
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>
                    </div>

                </div>

            </div>

        </section>

    </div>

    @push('scripts')
        <script>
            const checkAll = document.getElementById('checkAll');
            const checkboxes = document.querySelectorAll('.item-check');
            const selectedCount = document.getElementById('selectedCount');
            const btnBulk = document.getElementById('btnBulk');

            function updateSelectedCount() {

                const total =
                    document.querySelectorAll('.item-check:checked').length;

                selectedCount.textContent = total;

                btnBulk.disabled = total === 0;
            }

            checkAll?.addEventListener('change', function() {

                checkboxes.forEach(cb => {
                    cb.checked = this.checked;
                });

                updateSelectedCount();

            });

            checkboxes.forEach(cb => {

                cb.addEventListener('change', function() {

                    updateSelectedCount();

                    checkAll.checked = [...checkboxes].every(item => item.checked);

                });

            });

            updateSelectedCount();
        </script>
    @endpush
@endsection
