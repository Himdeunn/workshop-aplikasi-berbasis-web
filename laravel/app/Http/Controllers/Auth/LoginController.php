<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        // Catatan: Jika validasi gagal, Laravel otomatis redirect back() dengan errors.
        // Komponen Toast global kita akan mendeteksi errors tersebut.
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // 2. Percobaan login
        if (!Auth::attempt($request->only('email', 'password'))) {

            // PERBAIKAN: Menggunakan ->with('error', 'Pesan') agar notifikasi Toast bekerja lebih eksplisit
            return back()->with('error', 'Email atau password yang Anda masukkan salah.');
        }

        // 3. Regenerate session (anti session fixation)
        $request->session()->regenerate();

        // Ambil user
        $user = Auth::user();

        // 4. Redirect berdasarkan role (dan tambahkan notifikasi sukses jika perlu)
        if ($user->role === 'admin') {
            return redirect('/')->with('success', 'Selamat datang, Admin!');
        }

        if ($user->role === 'employee') {
            return redirect()->route('attendance.absence')->with('success', 'Selamat datang! Silakan lakukan absensi.');
        }

        // fallback
        return redirect('/')->with('success', 'Selamat datang!');
    }
}
