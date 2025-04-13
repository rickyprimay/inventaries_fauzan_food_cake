<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Divisions;
use App\Models\Outlets;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::with(['role', 'outlet', 'division'])
                    ->where('id', '!=', Auth::user()->id);

        if ($request->filled('role')) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('role_name', $request->role);
            });
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(10);

        $roles = Roles::all();
        $outlets = Outlets::all();
        $divisions = Divisions::all();

        return view('dashboard.user.index', compact('users', 'roles', 'outlets', 'divisions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'outlet_id' => 'nullable|exists:outlets,id',
            'division_id' => 'nullable|exists:divisions,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();

            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('toast_error', 'Pembuatan User Error: ' . implode(', ', $errors));
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'outlet_id' => $request->outlet_id,
            'division_id' => $request->division_id,
        ]);

        return redirect()->back()->with('toast_success', 'User berhasil dibuat!');
    }

    public function update($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('toast_error', 'User tidak ditemukan.');
        }

        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'outlet_id' => 'nullable|exists:outlets,id',
            'division_id' => 'nullable|exists:divisions,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('toast_error', 'Update User Error: ' . implode(', ', $errors));
        }

        $user->update([
            'name' => request()->name,
            'username' => request()->username,
            'role_id' => request()->role_id,
            'outlet_id' => request()->outlet_id,
            'division_id' => request()->division_id,
        ]);

        return redirect()->back()->with('toast_success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (Auth::id() == $id) {
            return redirect()->back()->with('toast_error', 'Kamu tidak bisa menghapus akun kamu sendiri.');
        }

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('toast_error', 'User tidak ditemukan.');
        }

        $user->delete();

        return redirect()->back()->with('toast_success', 'User berhasil dihapus.');
    }

}
