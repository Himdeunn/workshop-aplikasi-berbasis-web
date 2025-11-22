<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load related models efficiently (Department & Position)
        $employees = Employee::with(['department', 'position'])
            ->latest()
            ->paginate(4);

        return view('employees.index', compact('employees'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load(['department', 'position', 'attendances']);

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'employee' => $employee,
            'departments' => Department::orderBy('department_name')->get(),
            'positions' => Position::orderBy('position_name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        // Jika validasi gagal, Laravel otomatis redirect back() dengan errors.
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . $employee->id,
            'phone_number' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'date_entry' => 'required|date',
            'status' => 'required|in:active,non-active',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        $employee->update($validated);

        // PERBAIKAN: Menggunakan pesan sukses yang lebih rapi untuk Toast
        return redirect()
            ->route('employees.index')
            ->with('success', '✅ Data pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        // PERBAIKAN: Menggunakan pesan sukses yang lebih rapi untuk Toast
        return redirect()
            ->route('employees.index')
            ->with('success', '🗑️ Data pegawai berhasil dihapus.');
    }
}
