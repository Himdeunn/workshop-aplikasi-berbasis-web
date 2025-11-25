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
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Terima name/fullname dari frontend
        $name = $request->name ?? $request->fullname;

        if (!$name) {
            return response()->json([
                'error' => 'Field name/fullname harus dikirim.'
            ], 422);
        }

        // Buat User
        $user = User::create([
            'name'     => $name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'employee',
        ]);

        // Buat Employee (link ke user_id)
        Employee::create([
            'fullname'     => $name,
            'email'        => $request->email,
            'phone_number' => '-',
            'address'      => '-',
            'date_entry'   => now()->toDateString(),
            'status'       => 'active',
            'user_id'      => $user->id,
        ]);

        // Token Sanctum
        $token = $user->createToken('employee-auth-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user_name' => $user->name,
            'message' => 'Pendaftaran berhasil & data employee terbuat.',
        ], 201);
    }
}
