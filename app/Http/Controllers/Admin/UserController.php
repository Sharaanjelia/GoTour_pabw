<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->orderByDesc('created_at');

        if ($q = $request->input('q')) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%");
            });
        }

        $users = $query->paginate(20)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'is_admin' => 'sometimes',
        ]);

        $data['password'] = bcrypt($data['password']);
        // checkbox uses 'on' when present — normalize to boolean
        $data['is_admin'] = $request->has('is_admin') ? true : false;

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User dibuat');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|string|min:6',
            'is_admin' => 'sometimes',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        // normalize checkbox value
        $data['is_admin'] = $request->has('is_admin') ? true : false;

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User diperbarui');
    }

    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if (auth()->id() == $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();
        return back()->with('success', 'User dihapus');
    }

    public function toggleAdmin(User $user)
    {
        // toggle admin flag
        $user->is_admin = !$user->is_admin;
        $user->save();
        return back()->with('success', 'Status admin diperbarui');
    }
}
