<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::latest()->paginate(4);
        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Jika validasi gagal, Laravel otomatis redirect back() dengan errors.
        $request->validate([
            'position_name' => 'required|string|max:255',
            'base_salary' => 'required|numeric|min:0',
        ]);

        Position::create([
            'position_name' => $request->position_name,
            'base_salary' => $request->base_salary,
        ]);

        // PERBAIKAN: Pesan sukses yang eksplisit
        return redirect()->route('positions.index')
                             ->with('success', '✅ Jabatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $position = Position::findOrFail($id);
        return view('positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $position = Position::findOrFail($id);
        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Jika validasi gagal, Laravel otomatis redirect back() dengan errors.
        $request->validate([
            'position_name' => 'required|string|max:255',
            'base_salary' => 'required|numeric|min:0',
        ]);

        $position = Position::findOrFail($id);
        $position->update([
            'position_name' => $request->position_name,
            'base_salary' => $request->base_salary,
        ]);

        // PERBAIKAN: Pesan sukses yang eksplisit
        return redirect()->route('positions.index')
                             ->with('success', '✅ Jabatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        // PERBAIKAN: Pesan sukses yang eksplisit
        return redirect()->route('positions.index')
                             ->with('success', '🗑️ Jabatan berhasil dihapus.');
    }
}
