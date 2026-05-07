<?php

namespace App\Exports;

use App\Models\MonitoringDistribusi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $periode_id;

    public function __construct($periode_id)
    {
        $this->periode_id = $periode_id;
    }

    public function collection()
    {
        return MonitoringDistribusi::with('resident')
            ->where('periode_id', $this->periode_id)
            ->orderBy('rank')
            ->get()
            ->map(function ($item) {

                return [

                    'Nama' => $item->resident->nama ?? '-',

                    'NIK' => $item->resident->nik ?? '-',

                    'Rank' => $item->rank,

                    'Nilai Vi' => number_format($item->nilai_preferensi, 3),

                    'Status Ambil' =>
                    $item->status_pengambilan == 'sudah_ambil'
                        ? 'Sudah Ambil'
                        : 'Belum Ambil',

                    'Tanggal Ambil' =>
                    $item->tanggal_ambil ?? '-',

                    'Diambil Oleh' =>
                    $item->diambil_oleh ?? '-',

                    'Petugas' =>
                    $item->petugas ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return [

            'Nama',

            'NIK',

            'Rank',

            'Nilai Vi',

            'Status Ambil',

            'Tanggal Ambil',

            'Diambil Oleh',

            'Petugas'
        ];
    }
}
