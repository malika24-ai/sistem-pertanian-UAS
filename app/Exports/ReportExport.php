<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Http\Controllers\ReportController;

class ReportExport implements WithMultipleSheets
{
    use Exportable;

    protected $periodType;
    protected $month;
    protected $year;
    protected $role;

    public function __construct($periodType, $month, $year, $role)
    {
        $this->periodType = $periodType;
        $this->month = $month;
        $this->year = $year;
        $this->role = $role;
    }

    public function sheets(): array
    {
        $sheets = [];
        
        $data = ReportController::getReportData($this->periodType, $this->month, $this->year, $this->role);

        if (isset($data['farms'])) {
            $formattedData = $data['farms']->map(function($item) {
                return [
                    $item->id,
                    $item->name,
                    $item->user->name ?? '-',
                    $item->location,
                    $item->area,
                    $item->created_at->format('Y-m-d')
                ];
            });
            $sheets[] = new DataSheetExport($formattedData, 'Data Lahan', ['ID', 'Nama Lahan', 'Pemilik (Petani)', 'Lokasi', 'Luas (ha)', 'Tanggal Dibuat']);
        }

        if (isset($data['buyers'])) {
            $formattedData = $data['buyers']->map(function($item) {
                return [
                    $item->id,
                    $item->name,
                    $item->contact,
                    $item->address,
                    $item->type,
                    $item->created_at->format('Y-m-d')
                ];
            });
            $sheets[] = new DataSheetExport($formattedData, 'Data Pembeli', ['ID', 'Nama', 'Kontak', 'Alamat', 'Tipe', 'Tanggal Dibuat']);
        }

        if (isset($data['sales_transactions'])) {
            $formattedData = $data['sales_transactions']->map(function($item) {
                return [
                    $item->id,
                    $item->buyer->name ?? '-',
                    $item->crop->name ?? '-',
                    $item->transaction_date,
                    $item->quantity,
                    $item->price,
                    $item->total
                ];
            });
            $sheets[] = new DataSheetExport($formattedData, 'Transaksi Penjualan', ['ID', 'Pembeli', 'Tanaman', 'Tanggal', 'Kuantitas', 'Harga', 'Total']);
        }

        if (isset($data['crops'])) {
            $formattedData = $data['crops']->map(function($item) {
                return [
                    $item->id,
                    $item->farm->name ?? '-',
                    $item->cropType->name ?? '-',
                    $item->name,
                    $item->planting_date,
                    $item->created_at->format('Y-m-d')
                ];
            });
            $sheets[] = new DataSheetExport($formattedData, 'Manajemen Tanaman', ['ID', 'Lahan', 'Kategori', 'Nama Tanaman', 'Tanggal Tanam', 'Tanggal Dibuat']);
        }

        if (isset($data['planting_schedules'])) {
            $formattedData = $data['planting_schedules']->map(function($item) {
                return [
                    $item->id,
                    $item->crop->name ?? '-',
                    $item->plant_date,
                    $item->estimated_harvest_date
                ];
            });
            $sheets[] = new DataSheetExport($formattedData, 'Jadwal Tanam', ['ID', 'Tanaman', 'Tanggal Tanam', 'Estimasi Panen']);
        }

        if (isset($data['harvest_records'])) {
            $formattedData = $data['harvest_records']->map(function($item) {
                return [
                    $item->id,
                    $item->crop->name ?? '-',
                    $item->quantity,
                    $item->harvest_date
                ];
            });
            $sheets[] = new DataSheetExport($formattedData, 'Catatan Panen', ['ID', 'Tanaman', 'Kuantitas Panen', 'Tanggal Panen']);
        }

        if (isset($data['fertilizers'])) {
            $formattedData = $data['fertilizers']->map(function($item) {
                return [
                    $item->id,
                    $item->farm->name ?? '-',
                    $item->name,
                    $item->quantity,
                    $item->application_date
                ];
            });
            $sheets[] = new DataSheetExport($formattedData, 'Penggunaan Pupuk', ['ID', 'Lahan', 'Nama Pupuk', 'Kuantitas', 'Tanggal Aplikasi']);
        }

        if (isset($data['pesticides'])) {
            $formattedData = $data['pesticides']->map(function($item) {
                return [
                    $item->id,
                    $item->farm->name ?? '-',
                    $item->name,
                    $item->quantity,
                    $item->application_date
                ];
            });
            $sheets[] = new DataSheetExport($formattedData, 'Penggunaan Pestisida', ['ID', 'Lahan', 'Nama Pestisida', 'Kuantitas', 'Tanggal Aplikasi']);
        }

        // If no data is available for this role, just create an empty sheet
        if (empty($sheets)) {
            $sheets[] = new DataSheetExport([], 'Laporan Kosong', ['Pesan']);
        }

        return $sheets;
    }
}
