<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;

class CertificateController extends Controller
{
    public function index()
    {
        return view('pages.certificate.index');
    }

    public function datatable()
    {
        $query = Certificate::with([
            'user.unit',
            'user.position',
            'creator',
        ])->latest();

        return DataTables::of($query)

            ->addIndexColumn()

            ->addColumn('owner', function ($row) {

                return $row->user?->username ?? '-';
            })

            ->addColumn('expired_at', function ($row) {

                return $row->expired_at
                    ? Carbon::parse($row->expired_at)->format('d M Y')
                    : '-';
            })

            ->editColumn('issue_date', function ($row) {

                return Carbon::parse($row->issue_date)
                    ->format('d M Y');
            })

            ->addColumn('status', function ($row) {

                return view(
                    'pages.certificate.partials.badge',
                    compact('row')
                );
            })

            ->addColumn('action', function ($row) {

                return view(
                    'pages.certificate.partials.action',
                    compact('row')
                );
            })

            ->rawColumns([
                'status',
                'action'
            ])

            ->make(true);
    }

    public function show(Certificate $certificate)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Certificate $certificate)
    {
        //
    }

    public function update(Request $request, Certificate $certificate)
    {
        //
    }

    public function destroy(Certificate $certificate)
    {
        //
    }

    public function checkOwner($perner)
    {
        $user = User::with([
            'unit',
            'position'
        ])->where('perner', $perner)->first();

        if (!$user) {

            return response()->json([

                'found' => false,

            ]);
        }

        return response()->json([

            'found' => true,

            'username' => $user->username,

            'unit' => $user->unit?->name,

            'position' => $user->position?->name,

            'status' => $user->is_active,

        ]);
    }
}
