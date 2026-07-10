<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Position;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user.index', [

            'users' => User::with([
                'unit',
                'position'
            ])->get(),

            'units' => Unit::orderBy('name')->get(),

            'positions' => Position::orderBy('name')->get(),

        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $username = explode('@', $request->email)[0];

        $user = User::create([

            'username' => strtolower($username),

            'email' => $request->email,

            'nip' => $request->nip,

            'perner' => $request->perner,

            'position_id' => $request->position_id,

            'unit_id' => $request->unit_id,

            'status' => $request->status,

            'password' => Hash::make($request->password),

            'is_active' => true,

        ]);

        $user->assignRole($request->role);

        return response()->json([

            'message' => 'Pegawai berhasil ditambahkan.',

            'redirect' => route('users.index'),

        ]);
    }

    public function edit(User $user)
    {
        $user->load('roles');

        return response()->json([

            'user' => $user,

            'role' => $user->getRoleNames()->first(),

        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $username = explode('@', $request->email)[0];

        $data = [

            'username' => strtolower($username),

            'email' => $request->email,

            'nip' => $request->nip,

            'perner' => $request->perner,

            'position_id' => $request->position_id,

            'unit_id' => $request->unit_id,

            'status' => $request->status,

        ];

        if ($request->filled('password')) {

            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        $user->syncRoles([$request->role]);

        return response()->json([

            'message' => 'Data pegawai berhasil diperbarui.',

        ]);
    }

    public function destroy(User $user)
    {
        if (auth()->id() == $user->id) {

            return response()->json([

                'message' => 'Anda tidak dapat menghapus akun sendiri.'

            ], 422);
        }

        $user->delete();

        return response()->json([

            'message' => 'Pegawai berhasil dihapus.'

        ]);
    }

    public function datatable()
    {
        $query = User::with([
            'unit',
            'position',
            'roles'
        ]);


        return DataTables::of($query)

            ->addIndexColumn()

            ->addColumn('unit', function ($row) {

                return $row->unit?->name ?? '-';
            })

            ->addColumn('position', function ($row) {

                return $row->position?->name ?? '-';
            })

            ->addColumn('role', function ($row) {

                return $row->getRoleNames()->first();
            })

            ->addColumn('action', function ($row) {

                return view(
                    'pages.user.partials.action',
                    compact('row')
                );
            })

            ->addColumn('active', function ($row) {

                return view(
                    'pages.user.partials.badge-active',
                    [
                        'user' => $row
                    ]
                );
            })

            ->editColumn('role', function ($row) {

                return view(
                    'pages.user.partials.badge-role',
                    [
                        'role' => $row->getRoleNames()->first()
                    ]
                );
            })

            ->editColumn('status', function ($row) {

                return view(
                    'pages.user.partials.badge-status',
                    [
                        'status' => $row->status
                    ]
                );
            })

            ->addColumn('active', function ($row) {

                return view(
                    'pages.user.partials.badge-active',
                    [
                        'user' => $row
                    ]
                );
            })

            ->rawColumns([
                'status',
                'role',
                'active',
                'action'
            ])

            ->make(true);
    }

    public function toggleActive(User $user)
    {
        if ($user->id == auth()->id()) {

            return response()->json([

                'message' => 'Anda tidak dapat menonaktifkan akun sendiri.'

            ], 422);
        }

        $user->update([

            'is_active' => !$user->is_active

        ]);

        return response()->json([

            'message' => $user->is_active
                ? 'Akun berhasil diaktifkan.'
                : 'Akun berhasil dinonaktifkan.'

        ]);
    }
}
