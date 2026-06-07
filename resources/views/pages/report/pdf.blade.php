<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>
        Laporan Distribusi Bantuan Rastrada
    </title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 30px;
        }

        .kop {
            text-align: center;
            line-height: 1.5;
        }

        .kop h2,
        .kop h3,
        .kop p {
            margin: 0;
        }

        .line {
            border-top: 3px solid black;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .judul {
            text-align: center;
            margin-bottom: 20px;
        }

        .judul h3 {
            margin-bottom: 5px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info table {
            width: 50%;
        }

        .info td {
            padding: 3px 0;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 11px;
        }

        table.data th {
            background-color: #dbeafe;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .status-sudah {
            color: green;
            font-weight: bold;
        }

        .status-belum {
            color: red;
            font-weight: bold;
        }

        .footer {
            width: 100%;
            margin-top: 50px;
        }

        .ttd {
            width: 250px;
            float: right;
            text-align: center;
        }

        .ttd-space {
            height: 70px;
        }
    </style>

</head>

<body>

    {{-- KOP SURAT --}}
    <div class="kop">

        <h2>
            PEMERINTAH KABUPATEN HULU SUNGAI SELATAN
        </h2>

        <h3>
            KECAMATAN KANDANGAN
        </h3>

        <h3>
            KELURAHAN KANDANGAN BARAT
        </h3>

        <p>
            Jalan Singakarsa RT.004 RW.002 Kelurahan Kandangan Barat
        </p>

        <p>
            KANDANGAN - 71213
        </p>

    </div>

    <div class="line"></div>

    {{-- JUDUL --}}
    <div class="judul">

        <h3>
            LAPORAN DISTRIBUSI BANTUAN RASTRADA
        </h3>

        <p>
            Sistem Pendukung Keputusan Distribusi Bantuan Rastrada
        </p>

        <p>
            Periode : {{ $periode->nama_periode }}
        </p>

    </div>

    {{-- INFORMASI --}}
    <div class="info">

        <table>
            <tr>
                <td>Total Penerima</td>
                <td>:</td>
                <td>{{ $laporan->count() }}</td>
            </tr>

            <tr>
                <td>Sudah Ambil</td>
                <td>:</td>
                <td>
                    {{ $laporan->where('status_pengambilan', 'sudah_ambil')->count() }}
                </td>
            </tr>

            <tr>
                <td>Belum Ambil</td>
                <td>:</td>
                <td>
                    {{ $laporan->where('status_pengambilan', 'belum_ambil')->count() }}
                </td>
            </tr>

        </table>

    </div>

    {{-- TABEL --}}
    <table class="data">

        <thead>

            <tr>

                <th>No</th>

                <th>Nama</th>

                <th>NIK</th>

                <th>Peringkat</th>

                <th>Nilai Preferensi</th>

                <th>Status</th>

                <th>Tanggal Ambil</th>

                <th>Diambil Oleh</th>

                <th>Petugas</th>

            </tr>

        </thead>

        <tbody>

            @forelse ($laporan as $item)
                <tr>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->resident->nama ?? '-' }}
                    </td>

                    <td class="text-center">
                        {{ $item->resident->nik ?? '-' }}
                    </td>

                    <td class="text-center">
                        #{{ $item->rank }}
                    </td>

                    <td class="text-center">
                        {{ number_format($item->nilai_preferensi, 3) }}
                    </td>

                    <td class="text-center">

                        @if ($item->status_pengambilan == 'sudah_ambil')
                            <span class="status-sudah">
                                Sudah Ambil
                            </span>
                        @else
                            <span class="status-belum">
                                Belum Ambil
                            </span>
                        @endif

                    </td>

                    <td class="text-center">

                        @if ($item->tanggal_ambil)
                            {{ \Carbon\Carbon::parse($item->tanggal_ambil)->translatedFormat('d F Y') }}                        @else
                            -
                        @endif

                    </td>

                    <td class="text-center">
                        {{ $item->diambil_oleh ?? '-' }}
                    </td>

                    <td class="text-center">
                        {{ $item->petugas ?? '-' }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center">
                        Tidak ada data
                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

    {{-- TANDA TANGAN --}}
    <div class="footer">

        <div class="ttd">

            <p>
                Kandangan,
                {{ now()->format('d F Y') }}
            </p>

            <p>
                Lurah Kandangan Barat
            </p>

            <div class="ttd-space"></div>

            <p>
                <strong>FITRIA MAWARNI, A.Md.Kep</strong>
            </p>

            <p>
                NIP. 19850521 200904 2 004
            </p>

        </div>

    </div>
</body>

</html>
