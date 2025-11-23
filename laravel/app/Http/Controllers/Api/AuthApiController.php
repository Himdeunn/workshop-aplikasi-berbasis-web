<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    // ENDPOINT: POST /api/login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Kredensial login tidak valid.'],
            ]);
        }

        $user = Auth::user();
        if ($user->role !== 'employee') {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => ['Akses terbatas untuk pengguna pegawai.'],
            ]);
        }

        // Buat Token Sanctum
        $token = $user->createToken('employee-auth-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user_name' => $user->name,
            'role' => $user->role,
        ]);
    }

    // ENDPOINT: POST /api/register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'employee',
        ]);

        Employee::create([
            'fullname'     => $request->name,
            'email'        => $request->email,
            'phone_number' => '-',
            'address'      => '-',
            'date_entry'   => now()->toDateString(),
            'status'       => 'active',
            'user_id'      => $user->id,
        ]);

        // Login dan Buat Token setelah Register
        $token = $user->createToken('employee-auth-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user_name' => $user->name,
            'message' => 'Pendaftaran berhasil dan token dibuat.',
        ], 201);
    }
}
