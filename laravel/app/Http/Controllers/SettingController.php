<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee; // Asumsi model Employee digunakan

class SettingController extends Controller
{
    /**
     * Menampilkan form untuk mengedit profil pegawai (hanya untuk role employee).
     */
    public function index()
    {
        // Asumsi: User yang sedang login memiliki relasi atau data pegawai terkait.
        $employee = Auth::user()->employee;

        if (!$employee) {
            // PERBAIKAN: Pesan error yang eksplisit dan konsisten
            return redirect('/')->with('error', '❌ Data pegawai tidak ditemukan. Hubungi administrator.');
        }

        return view('settings.index', compact('employee'));
    }

    /**
     * Memperbarui informasi profil pegawai.
     */
    public function update(Request $request)
    {
        $employee = Auth::user()->employee;

        if (!$employee) {
            // PERBAIKAN: Pesan error yang eksplisit dan konsisten
            return redirect('/')->with('error', '❌ Gagal memperbarui. Data pegawai tidak ditemukan.');
        }

        // Validasi data input. Jika validasi gagal, Laravel otomatis redirect back() dengan errors.
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            // Pastikan email unik kecuali untuk email saat ini
            'email' => 'required|email|max:255|unique:employees,email,' . $employee->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $employee->update($validated);

        // PERBAIKAN: Pesan sukses yang eksplisit
        return redirect()
            ->route('settings.index')
            ->with('success', '✅ Profil berhasil diperbarui!');
    }
}
