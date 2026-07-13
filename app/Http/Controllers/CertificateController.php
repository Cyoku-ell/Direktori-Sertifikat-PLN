<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCertificateRequest;
use App\Models\Certificate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

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

    public function store(StoreCertificateRequest $request)
    {
        DB::beginTransaction();

        try {

            $user = User::where('perner', $request->perner)->first();

            $pdf = null;

            if ($request->hasFile('pdf')) {

                $pdf = $request
                    ->file('pdf')
                    ->store('certificates', 'public');
            }

            Certificate::create([

                'user_id' => $user?->id,

                'perner' => $request->perner,

                'title' => $request->title,

                'certificate_number' => $request->certificate_number,

                'registration_number' => $request->registration_number,

                'institution' => $request->institution,

                'accreditor' => $request->accreditor,

                'issue_date' => $request->issue_date,

                'start_date' => $request->start_date,

                'end_date' => $request->end_date,

                'expired_at' => $request->expired_at,

                'remarks' => $request->remarks,

                'pdf' => $pdf,

                'created_by' => auth()->id(),

                'is_matched' => $user ? true : false,

            ]);

            DB::commit();

            return response()->json([

                'success' => true,

                'message' => 'Sertifikat berhasil ditambahkan.'

            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ], 500);
        }
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
