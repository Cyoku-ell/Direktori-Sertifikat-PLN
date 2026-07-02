<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Unit;
use App\Models\Certification;
use App\Http\Requests\StoreCertificateRequest;

class CertificateController extends Controller
{
    public function index()
    {
        return view('pages.data.index', [
            'units' => Unit::orderBy('name')->get(),
            'certifications' => Certification::orderBy('name')->get()
        ]);
    }
    public function datatable(Request $request)
    {
        if (auth()->user()->hasRole('admin')) {

            $query = Certificate::with(['unit', 'certification']);
        } else {

            $query = Certificate::with(['unit', 'certification'])
                ->where('user_id', auth()->id());
        }

        return DataTables::of($query)

            ->addIndexColumn()

            ->addColumn('unit', function ($row) {

                return $row->unit->name;
            })

            ->addColumn('certification', function ($row) {

                return $row->certification->name;
            })

            ->addColumn('action', function ($row) {

                return view('pages.Data.partials.action', compact('row'));
            })

            ->rawColumns(['action'])

            ->make(true);
    }

    public function store(StoreCertificateRequest $request)
    {
        // Ambil file PDF
        $pdf = $request->file('file');

        // Nama file baru
        $filename = time() . '_' . $pdf->getClientOriginalName();

        // Simpan ke storage
        $pdf->storeAs(
            'certificates',
            $filename,
            'public'
        );

        // Simpan database
        Certificate::create([

            'user_id' => auth()->id(),

            'name' => $request->name,

            'nip' => $request->nip,

            'unit_id' => $request->unit_id,

            'certification_id' => $request->certification_id,

            'file' => $filename,

        ]);

        return response()->json([

            'message' => 'Certificate uploaded successfully.'

        ]);
    }
}
