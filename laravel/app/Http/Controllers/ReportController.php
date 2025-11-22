<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Position;
use App\Models\Department;
use App\Services\AttendanceExportService;
use App\Services\EmployeeExportService;
use App\Services\PositionExportService;
use Illuminate\Support\Facades\DB;
use Throwable; // Import Throwable untuk menangkap semua error

class ReportController extends Controller
{
    public function index()
    {
        // 1. Data Total Karyawan per Departemen
        $employeesByDept = Employee::select('department_id', DB::raw('count(*) as total'))
                                    ->groupBy('department_id')
                                    ->with('department')
                                    ->get();

        // 2. Data Absensi Bulan Ini
        $attendanceData = Attendance::select('status', DB::raw('count(*) as total'))
                                    ->whereMonth('date', now()->month)
                                    ->groupBy('status')
                                    ->get();

        // 3. Data Gaji Pokok (Ambil semua posisi)
        $salaryData = Position::select('position_name', 'base_salary')->get();

        // Data sederhana untuk Total Karyawan
        $totalEmployees = Employee::count();
        $totalDepartments = Department::count();
        $totalPositions = Position::count();

        return view('report.index', compact('employeesByDept', 'attendanceData', 'salaryData', 'totalEmployees', 'totalDepartments', 'totalPositions'));
    }

    /**
     * Menangani ekspor berbagai jenis laporan berdasarkan parameter $type dari rute URL.
     */
    public function export(Request $request, AttendanceExportService $attendanceService, EmployeeExportService $employeeService, PositionExportService $positionService, string $type = 'attendance')
    {
        try {
            $response = match ($type) {
                'employees' => $employeeService->exportEmployees(),
                'positions' => $positionService->exportPositions(),
                'attendance' => $attendanceService->exportAttendance(), // Ganti default ke 'attendance' agar lebih eksplisit
                default => throw new \Exception("Jenis laporan '{$type}' tidak valid."),
            };

            // Jika respons adalah file download, ia akan dikirim langsung.
            return $response;

        } catch (Throwable $e) {
            // Jika terjadi error saat ekspor (misal, masalah database atau PHPSpreadsheet),
            // kita redirect kembali dengan pesan error.

            // Catatan: Jika export sukses, biasanya tidak ada redirect ke sini.
            return back()->with('error', '❌ Gagal mengekspor laporan: ' . $e->getMessage());
        }

        // Karena export biasanya mengirim respons download, baris ini seharusnya tidak tercapai
        // jika export sukses. Tapi kita tambahkan untuk keamanan fallback.
        return back()->with('error', '❌ Gagal memulai proses ekspor.');
    }
}
