<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // TAMBAHAN: Redirect ke login dengan notifikasi sukses
        return redirect('/login')->with('success', 'Anda telah berhasil logout.');
    }
}
