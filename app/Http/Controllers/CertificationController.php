<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
     public function index()
    {
        return view('pages.certification.index');
    }

    public function create()
    {
        return view('pages.certification.add');
    }

    public function store(Request $request)
    {
        Certification::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Unit berhasil ditambahkan.',
            'redirect' => route('certifications.index')
        ]);
    }

    public function update(Request $request, Certification $certification)
    {
        $certification->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Sertifikasi berhasil diupdate.'
        ]);
    }

    public function destroy(Certification $certification)
    {
        $certification->delete();

        return response()->json([
            'message' => 'Sertifikasi berhasil dihapus.'
        ]);
    }
}