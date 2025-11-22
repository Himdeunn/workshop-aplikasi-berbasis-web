<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Jika validasi gagal, Laravel otomatis redirect back() dengan errors.
        // Komponen Toast global kita akan mendeteksi errors tersebut.
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // 1. Buat User
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'employee', // default role
        ]);

        // 2. Buat Employee Linked to User
        Employee::create([
            'fullname'     => $data['name'],
            'email'        => $data['email'],
            'phone_number' => '-',
            'birth_date'   => now()->toDateString(),
            'address'      => '-',
            'date_entry'   => now()->toDateString(),
            'status'       => 'active',
            'user_id'      => $user->id,
        ]);

        // 3. Login otomatis
        Auth::login($user);

        // 4. Redirect dengan notifikasi sukses
        return redirect()->route('attendance.absence')->with('success', 'Pendaftaran berhasil! Akun Anda telah dibuat.');
    }
}
