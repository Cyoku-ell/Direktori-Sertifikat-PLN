<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        return view('pages.position.index');
    }

    public function create()
    {
        return view('pages.position.add');
    }

    public function store(Request $request)
    {
        Position::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Jabatan berhasil ditambahkan.',
            'redirect' => route('positions.index')
        ]);
    }

    public function update(Request $request, Position $position)
    {
        $position->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Jabatan berhasil diupdate.'
        ]);
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return response()->json([
            'message' => 'Jabatan berhasil dihapus.'
        ]);
    }
}
