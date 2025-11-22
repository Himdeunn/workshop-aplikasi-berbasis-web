<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()->paginate(4);
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $employees = Employee::all();
    //     return view('attendances.create', compact('employees'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'employee_id' => 'required|exists:employees,id',
    //         'date' => 'required|date',
    //         'check_in' => 'nullable|date_format:H:i',
    //         'check_out' => 'nullable|date_format:H:i',
    //         'status' => 'required|string|in:present,permission,sick,absent',
    //     ]);

    //     Attendance::create($request->all());
    //     return redirect()->route('attendances.index')
    //         ->with('success', 'Attendance record added successfully.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::with('employee')->findOrFail($id);
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::all();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Jika validasi gagal, Laravel otomatis redirect back() dengan errors.
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
            'status' => 'required|string|in:present,permission,sick,absent',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update($request->all());

        // PERBAIKAN/VERIFIKASI: Pesan sukses yang rapi untuk Toast Notification
        return redirect()->route('attendances.index')
            ->with('success', '✅ Data kehadiran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $attendance = Attendance::findOrFail($id);
    //     $attendance->delete();

    //     return redirect()->route('attendances.index')
    //         ->with('success', 'Attendance record deleted successfully.');
    // }

    public function absence()
    {
        $employee = auth()->user()->employee;
        if (!$employee) {
            return redirect('/')->with('error', '❌ Data pegawai tidak ditemukan. Hubungi admin.');
        }

        $today = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', today())
            ->first();

        $history = Attendance::where('employee_id', $employee->id)
            ->orderBy('date', 'desc')
            ->get();

        return view('attendances.absence', compact('today', 'history'));
    }

    public function checkIn()
    {
        $employee = auth()->user()->employee;
        if (!$employee) {
            return back()->with('error', '❌ Data pegawai tidak ditemukan.');
        }

        $already = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', today())
            ->first();

        if ($already) {
            return back()->with('error', '❌ Kamu sudah melakukan check-in hari ini.');
        }

        Attendance::create([
            'employee_id' => $employee->id,
            'date'        => today(),
            'check_in'    => now()->format('H:i'),
            'status'      => 'present',
        ]);

        return back()->with('success', '✅ Check-in berhasil. Semangat kerja!');
    }

    public function checkOut()
    {
        $employee = auth()->user()->employee;
        if (!$employee) {
            return back()->with('error', '❌ Data pegawai tidak ditemukan.');
        }

        $today = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', today())
            ->first();

        if (!$today) {
            return back()->with('error', '❌ Kamu belum melakukan check-in.');
        }

        if ($today->check_out) {
            return back()->with('error', '❌ Kamu sudah melakukan check-out hari ini.');
        }

        $today->update([
            'check_out' => now()->format('H:i'),
        ]);

        return back()->with('success', '✅ Check-out berhasil. Hati-hati di jalan!');
    }
}
