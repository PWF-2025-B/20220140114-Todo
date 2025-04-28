<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $users = User::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->orderBy('name')
            ->where('id', '!=', 1)
            ->paginate(20)
            ->withQueryString();
        } else {
            $users = User::where('id', '!=', 1)
                         ->orderBy('name')
                         ->paginate(20);
        }

        return view('user.index', compact('users'));
    }

    // ✅ Tambahan: Make Admin
    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = 1;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Make Admin Succesfully!');
    }

    // ✅ Tambahan: Remove Admin
    public function removeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = 0;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Remove Admin Succesfully!');
    }

    // ✅ Tambahan: Delete User
    public function destroy(User $user)
    {
        if ($user->id != 1) {
            $user->delete();
            return back()->with('success', 'Delete user successfully!');
        } else {
            return redirect()->route('user.index')->with('danger', 'Delete user failed!');
        }
    }
}
