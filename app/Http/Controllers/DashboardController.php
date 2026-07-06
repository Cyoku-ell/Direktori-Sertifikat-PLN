<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Jika bukan admin langsung ke halaman certificate
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('certificates.index');
        }

        $totalCertificate = Certificate::count();

        $todayCertificate = Certificate::whereDate(
            'created_at',
            Carbon::today()
        )->count();

        $totalUnit = Unit::count();

        $latestCertificates = Certificate::with([
            'unit',
            'certification',
            'user'
        ])
            ->latest()
            ->take(5)
            ->get();

        return view('pages.Dashboard.index', compact(
            'totalCertificate',
            'todayCertificate',
            'totalUnit',
            'latestCertificates'
        ));
    }

    public function chart(Request $request)
{
    $type = $request->type;

    $labels = [];
    $data = [];

    if ($type == 'year') {

        for ($i = 1; $i <= 12; $i++) {

            $labels[] = Carbon::create()->month($i)->translatedFormat('M');

            $data[] = Certificate::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $i)
                ->count();
        }
    }

    elseif ($type == 'month') {

        $weeks = ceil(now()->daysInMonth / 7);

        for ($i = 1; $i <= $weeks; $i++) {

            $labels[] = "Minggu $i";

            $start = ($i - 1) * 7 + 1;
            $end = min($i * 7, now()->daysInMonth);

            $data[] = Certificate::whereBetween(
                'created_at',
                [
                    now()->copy()->startOfMonth()->day($start),
                    now()->copy()->startOfMonth()->day($end)->endOfDay()
                ]
            )->count();
        }
    }

    else {

        $start = now()->startOfWeek();

        for ($i = 0; $i < 7; $i++) {

            $date = $start->copy()->addDays($i);

            $labels[] = $date->translatedFormat('D');

            $data[] = Certificate::whereDate(
                'created_at',
                $date
            )->count();
        }
    }

    return response()->json([
        'labels' => $labels,
        'data' => $data
    ]);
}
}
