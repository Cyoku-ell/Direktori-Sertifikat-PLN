<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
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

            ->addColumn('status', function ($certificate) {

                return view(
                    'pages.certificate.partials.badge',
                    compact('certificate')
                )->render();
            })

            ->addColumn('action', function ($certificate) {

                return view(
                    'pages.certificate.partials.action',
                    compact('certificate')
                )->render();
            })
            ->rawColumns([
                'status',
                'action'
            ])

            ->make(true);
    }

    public function show(Certificate $certificate)
    {
        $certificate->load([
            'user.unit',
            'user.position',
            'creator'
        ]);

        return view('pages.certificate.details.show', compact('certificate'));
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
        $certificate->load([
            'user.unit',
            'user.position'
        ]);

        return response()->json([

            'id' => $certificate->id,

            'perner' => $certificate->perner,

            'title' => $certificate->title,

            'certificate_number' => $certificate->certificate_number,

            'registration_number' => $certificate->registration_number,

            'institution' => $certificate->institution,

            'accreditor' => $certificate->accreditor,

            'issue_date' => optional($certificate->issue_date)->format('Y-m-d'),

            'start_date' => optional($certificate->start_date)->format('Y-m-d'),

            'end_date' => optional($certificate->end_date)->format('Y-m-d'),

            'expired_at' => optional($certificate->expired_at)->format('Y-m-d'),

            'remarks' => $certificate->remarks,

            'username' => $certificate->user?->username,

            'unit' => $certificate->user?->unit?->name,

            'position' => $certificate->user?->position?->name,

            'matched' => $certificate->is_matched,

            'pdf' => $certificate->pdf
                ? asset('storage/' . $certificate->pdf)
                : null,

        ]);
    }

    public function update(
        UpdateCertificateRequest $request,
        Certificate $certificate
    ) {
        DB::beginTransaction();

        try {

            $user = User::where(
                'perner',
                $request->perner
            )->first();

            /*
        |--------------------------------------------------------------------------
        | PDF
        |--------------------------------------------------------------------------
        */

            $pdf = $certificate->pdf;

            if ($request->hasFile('pdf')) {

                if (
                    $certificate->pdf &&
                    Storage::disk('public')->exists($certificate->pdf)
                ) {

                    Storage::disk('public')->delete(
                        $certificate->pdf
                    );
                }

                $pdf = $request
                    ->file('pdf')
                    ->store('certificates', 'public');
            }

            /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

            $certificate->update([

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

                'is_matched' => $user ? true : false,

            ]);

            DB::commit();

            return response()->json([

                'success' => true,

                'message' => 'Sertifikat berhasil diperbarui.'

            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ], 500);
        }
    }

    public function destroy(Certificate $certificate)
    {
        DB::beginTransaction();

        try {

            if (
                $certificate->pdf &&
                Storage::disk('public')->exists($certificate->pdf)
            ) {

                Storage::disk('public')->delete(
                    $certificate->pdf
                );
            }

            $certificate->delete();

            DB::commit();

            return response()->json([

                'success' => true,

                'message' => 'Sertifikat berhasil dihapus.'

            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ], 500);
        }
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
