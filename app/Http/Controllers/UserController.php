<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function getUserList(Request $request)
    {
        $data  = User::where('name', '!=', 'Super Admin')->where('id', '!=',  auth()->user()->id);

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = view('include.user.btn-action', compact('data'))->render();
                return $action;
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->isoFormat('DD MMMM Y');
            })
            ->addColumn('role', function ($data) {
                return $data->getRoleNames()[0] ?? '';
            })
            ->filter(function ($instance) use ($request) {
                if (!empty($request->search)) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->search;
                        $w->orwhere('name', 'LIKE', "%$search%")
                            ->orwhere('email', 'LIKE', "%$search%");
                    });
                }

                return $instance;
            })
            ->rawColumns(['action', 'created_at', 'role'])
            ->make(true);
    }

    public function create()
    {
        $user = new User();
        $roles = Role::pluck('name', 'id');
        return view('include.user.create', compact('user', 'roles'));
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Username tidak boleh kosong!',
            'name.string' => 'Username harus terdiri dari huruf!',
            'name.max' => 'Username tidak boleh melebihi 255 huruf!',
            'email.email' => 'Format email tidak valid!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.max' => 'Email tidak boleh melebihi 255 digit!',
            'email.unique' => 'Email tidak tersedia!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password minimal adalah 6!',
            'password.confirmed' => 'Password tidak cocok!',
            'role.required' => 'Hak akses tidak boleh kosong!',
            'date_in.required' => 'Tanggal masuk tidak boleh kosong!',
            'date_out.required' => 'Tanggal keluar tidak boleh kosong!'
        ];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required'],
            'date_in' => ['required', 'date'],
            'date_out' => ['required', 'date']
        ], $messages);

        $validated['password'] = Hash::make($request->password);

        $user = User::create($validated);
        if ($request->role) {
            $user->assignRole($validated['role']);
        }

        return $user;
    }

    public function show(User $user)
    {
        return view('include.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        if ($user->id == auth()->user()->id) {
            return false;
        }
        $roles = Role::pluck('name', 'id');
        return view('include.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->id == auth()->user()->id) {
            return false;
        }
        $messages = [
            'name.required' => 'Username tidak boleh kosong!',
            'name.string' => 'Username harus terdiri dari huruf!',
            'name.max' => 'Username tidak boleh melebihi 255 huruf!',
            'email.email' => 'Format email tidak valid!',
            'email.max' => 'Email tidak boleh melebihi 255 digit!',
            'email.unique' => 'Email tidak tersedia!',
            'role.required' => 'Hak akses tidak boleh kosong!',
            'date_in.required' => 'Tanggal masuk tidak boleh kosong!',
            'date_out.required' => 'Tanggal keluar tidak boleh kosong!'
        ];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required'],
            'date_in' => ['required', 'date'],
            'date_out' => ['required', 'date']
        ], $messages);

        $user->update($validated);
        if ($request->role) {
            $user->syncRoles([$validated['role']]);
        }

        return $user;
    }
}
