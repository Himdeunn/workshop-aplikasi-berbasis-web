<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::latest()->paginate(5);
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Jika validasi gagal, Laravel otomatis redirect back() dengan errors.
        $request->validate([
            'department_name' => 'required|string|max:255',
        ]);

        Department::create([
            'department_name' => $request->department_name,
        ]);

        // PERBAIKAN: Pesan sukses yang eksplisit
        return redirect()->route('departments.index')
                             ->with('success', '✅ Departemen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::findOrFail($id);
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Jika validasi gagal, Laravel otomatis redirect back() dengan errors.
        $request->validate([
            'department_name' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->update([
            'department_name' => $request->department_name,
        ]);

        // PERBAIKAN: Pesan sukses yang eksplisit
        return redirect()->route('departments.index')
                             ->with('success', '✅ Departemen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        // PERBAIKAN: Pesan sukses yang eksplisit
        return redirect()->route('departments.index')
                             ->with('success', '🗑️ Departemen berhasil dihapus.');
    }
}
