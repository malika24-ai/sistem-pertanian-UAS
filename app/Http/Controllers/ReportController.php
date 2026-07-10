<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ReportExport;
use App\Models\Farm;
use App\Models\Buyer;
use App\Models\SalesTransaction;
use App\Models\Crop;
use App\Models\CropType;
use App\Models\PlantingSchedule;
use App\Models\HarvestRecord;
use App\Models\Fertilizer;
use App\Models\Pesticide;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index', [
            'title' => 'Laporan Periodik',
        ]);
    }

    public function exportExcel(Request $request)
    {
        $request->validate([
            'period_type' => 'required|in:monthly,yearly',
            'month' => 'required_if:period_type,monthly|nullable|numeric|min:1|max:12',
            'year' => 'required|numeric|min:2000|max:' . (date('Y') + 10),
        ]);

        $periodType = $request->period_type;
        $month = $request->month;
        $year = $request->year;
        $role = Auth::user()->role->name;

        $fileName = 'laporan_' . strtolower(str_replace(' ', '_', $role)) . '_' . $year . ($periodType == 'monthly' ? '-' . str_pad($month, 2, '0', STR_PAD_LEFT) : '') . '.xlsx';

        return Excel::download(new ReportExport($periodType, $month, $year, $role), $fileName);
    }

    public function exportPdf(Request $request)
    {
        $request->validate([
            'period_type' => 'required|in:monthly,yearly',
            'month' => 'required_if:period_type,monthly|nullable|numeric|min:1|max:12',
            'year' => 'required|numeric|min:2000|max:' . (date('Y') + 10),
        ]);

        $periodType = $request->period_type;
        $month = $request->month;
        $year = $request->year;
        $role = Auth::user()->role->name;

        $data = self::getReportData($periodType, $month, $year, $role);

        $pdf = Pdf::loadView('report.pdf', [
            'data' => $data,
            'role' => $role,
            'periodType' => $periodType,
            'month' => $month,
            'year' => $year,
        ]);

        $fileName = 'laporan_' . strtolower(str_replace(' ', '_', $role)) . '_' . $year . ($periodType == 'monthly' ? '-' . str_pad($month, 2, '0', STR_PAD_LEFT) : '') . '.pdf';
        
        return $pdf->download($fileName);
    }

    public static function getReportData($periodType, $month, $year, $role)
    {
        $user = Auth::user();
        $data = [];

        // Helper to apply period filter
        $applyPeriod = function($query, $dateColumn = 'created_at') use ($periodType, $month, $year) {
            $query->whereYear($dateColumn, $year);
            if ($periodType == 'monthly') {
                $query->whereMonth($dateColumn, $month);
            }
            return $query;
        };

        if (in_array($role, ['Superadmin', 'Admin'])) {
            $data['farms'] = $applyPeriod(Farm::with('user'))->get();
            $data['buyers'] = $applyPeriod(Buyer::query())->get();
            $data['sales_transactions'] = $applyPeriod(SalesTransaction::with(['buyer', 'crop']), 'transaction_date')->get();
            $data['crops'] = $applyPeriod(Crop::with(['farm', 'cropType']))->get();
            $data['crop_types'] = $applyPeriod(CropType::query())->get();
        }

        if (in_array($role, ['Superadmin', 'Petani', 'Penyuluh Pertanian'])) {
            
            $farmQuery = function($q) use ($role, $user) {
                if ($role == 'Petani') {
                    $q->where('user_id', $user->id);
                }
            };

            $data['planting_schedules'] = $applyPeriod(PlantingSchedule::with('crop.farm')->whereHas('crop.farm', $farmQuery), 'plant_date')->get();
            $data['harvest_records'] = $applyPeriod(HarvestRecord::with('crop.farm')->whereHas('crop.farm', $farmQuery), 'harvest_date')->get();
            $data['fertilizers'] = $applyPeriod(Fertilizer::with('crop.farm')->whereHas('crop.farm', $farmQuery), 'usage_date')->get();
            $data['pesticides'] = $applyPeriod(Pesticide::with('crop.farm')->whereHas('crop.farm', $farmQuery), 'usage_date')->get();
        }

        if ($role == 'Pembeli') {
            // Because there's no foreign key from buyers to users, we match by name string
            $data['sales_transactions'] = $applyPeriod(SalesTransaction::with(['buyer', 'crop'])
                ->whereHas('buyer', function($q) use ($user) {
                    $q->where('name', $user->name);
                }), 'transaction_date')->get();
        }

        return $data;
    }
}
