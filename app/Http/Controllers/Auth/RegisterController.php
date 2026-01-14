<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Author;

class RegisterController extends Controller
{
    /**
     * Tampilkan halaman register author
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Simpan author baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

$user = User::create([
    'name' => $validated['name'],
    'email' => $validated['email'],
    'password' => Hash::make($validated['password']),
    'role' => 'author',
]);

Author::create([
    'user_id' => $user->id,
    'name' => $user->name,
]);
        return redirect('/admin/login')
            ->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
