<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display Certificate Page
     */
    public function index()
    {
        return view('pages.Data.index');
    }

    /**
     * Store Certificate
     */
    public function store(Request $request)
    {

    }

    /**
     * Show Detail Certificate
     */
    public function show(Certificate $certificate)
    {

    }

    /**
     * Update Certificate
     */
    public function update(Request $request, Certificate $certificate)
    {

    }

    /**
     * Delete Certificate
     */
    public function destroy(Certificate $certificate)
    {

    }
}