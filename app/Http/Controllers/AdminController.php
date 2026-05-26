<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with real database users.
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'role', 'created_at')
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'joined' => $user->created_at ? $user->created_at->format('Y-m-d') : date('Y-m-d')
                ];
            });

        return view('admin.dashboard', compact('users'));
    }

    /**
     * Store a newly created user in the database.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'in:admin,photographer,customer'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        // Default password if not provided
        $password = $request->password ?: 'password';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil ditambahkan!',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'joined' => $user->created_at->format('Y-m-d')
            ]
        ]);
    }

    /**
     * Update the specified user in the database.
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'role' => ['required', 'string', 'in:admin,photographer,customer'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil diperbarui!',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'joined' => $user->created_at ? $user->created_at->format('Y-m-d') : date('Y-m-d')
            ]
        ]);
    }

    /**
     * Remove the specified user from the database.
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent self-deletion
        if (Auth::id() == $id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak bisa menghapus akun Anda sendiri!'
            ], 400);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus!'
        ]);
    }
}
