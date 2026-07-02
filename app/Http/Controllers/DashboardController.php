<?php

namespace App\Http\Controllers;

use App\Models\Certificate;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }
}