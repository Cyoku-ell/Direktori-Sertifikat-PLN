<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        return view('pages.Unit.index');
    }

    public function create()
    {
        return view('pages.Unit.add');
    }

    public function store(Request $request)
    {
        Unit::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Unit berhasil ditambahkan.',
            'redirect' => route('units.index')
        ]);
    }

    public function update(Request $request, Unit $unit)
    {
        $unit->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Unit berhasil diupdate.'
        ]);
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return response()->json([
            'message' => 'Unit berhasil dihapus.'
        ]);
    }
}