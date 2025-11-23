<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EmployeeApiController extends Controller
{
    // ENDPOINT: GET /api/employee/profile
    public function profile()
    {
        $user = Auth::user();
        // Memuat relasi department dan position untuk kartu info di Next.js Settings
        $employee = $user->employee->load(['department', 'position']);

        if (!$employee) {
            return response()->json(['message' => 'Data pegawai tidak ditemukan.'], 404);
        }

        return response()->json([
            'fullname' => $employee->fullname,
            'email' => $employee->email,
            'phone_number' => $employee->phone_number,
            'address' => $employee->address,
            'position_name' => $employee->position->position_name ?? 'N/A',
            'department_name' => $employee->department->department_name ?? 'N/A',
            'date_entry' => $employee->date_entry,
            'status' => $employee->status,
        ]);
    }

    // ENDPOINT: PUT /api/settings/update
    public function updateProfile(Request $request)
    {
        $employee = Auth::user()->employee;

        if (!$employee) {
            return response()->json(['message' => 'Data pegawai tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . $employee->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $employee->update($validated);

        return response()->json(['message' => 'Profil berhasil diperbarui!']);
    }

    // ENDPOINT: GET /api/attendance/absence (Untuk AbsenceScreen memuat data)
    public function getAttendanceData()
    {
        $employee = Auth::user()->employee;
        if (!$employee) {
            return response()->json(['message' => 'Data pegawai tidak ditemukan.'], 404);
        }

        $today = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', today())
            ->first();

        $history = Attendance::where('employee_id', $employee->id)
            ->orderBy('date', 'desc')
            ->select('id', 'date', 'check_in', 'check_out', 'status')
            ->take(10)
            ->get();

        return response()->json([
            'today' => $today,
            'history' => $history,
            'message' => 'Data absensi dimuat.'
        ]);
    }

    // ENDPOINT: POST /api/attendance/check-in
    public function checkIn(Request $request)
    {
        $employee = Auth::user()->employee;
        if (!$employee) {
            return response()->json(['message' => 'Data pegawai tidak ditemukan.'], 404);
        }

        $already = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', today())
            ->first();

        if ($already) {
            return response()->json(['message' => 'Kamu sudah melakukan check-in hari ini.'], 409);
        }

        Attendance::create([
            'employee_id' => $employee->id,
            'date'        => today(),
            'check_in'    => now()->format('H:i'),
            'status'      => 'present',
        ]);

        return response()->json(['message' => 'Check-in berhasil. Semangat kerja!']);
    }

    // ENDPOINT: POST /api/attendance/check-out
    public function checkOut(Request $request)
    {
        $employee = Auth::user()->employee;

        if (!$employee) {
            return response()->json(['message' => 'Data pegawai tidak ditemukan.'], 404);
        }

        $today = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', today())
            ->first();

        if (!$today) {
            return response()->json(['message' => 'Kamu belum melakukan check-in.'], 409);
        }

        if ($today->check_out) {
            return response()->json(['message' => 'Kamu sudah melakukan check-out hari ini.'], 409);
        }

        $today->update([
            'check_out' => now()->format('H:i'),
        ]);

        return response()->json(['message' => 'Check-out berhasil. Hati-hati di jalan!']);
    }
}
