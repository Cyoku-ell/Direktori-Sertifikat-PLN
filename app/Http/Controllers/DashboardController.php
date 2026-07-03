<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {

            return view('pages.Dashboard.index');
        }

        return redirect()->route('certificates.index');
    }
}
