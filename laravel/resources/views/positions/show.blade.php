@extends('layouts.app')

@section('title', 'The Comp | Detail Position')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-4xl font-extrabold mb-10 text-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            Detail Jabatan
        </h1>

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 space-y-6">
            {{-- Nama Jabatan --}}
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-semibold text-gray-600">Nama Jabatan</span>
                <span class="text-gray-900">{{ $position->position_name }}</span>
            </div>

            {{-- Gaji Pokok --}}
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-semibold text-gray-600">Gaji Pokok</span>
                <span class="text-gray-900">Rp {{ number_format($position->base_salary, 0, ',', '.') }}</span>
            </div>

            {{-- Created At --}}
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-semibold text-gray-600">Dibuat Pada</span>
                <span class="text-gray-900">{{ $position->created_at->format('d M Y') }}</span>
            </div>

            {{-- Updated At --}}
            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-600">Terakhir Diperbarui</span>
                <span class="text-gray-900">{{ $position->updated_at->format('d M Y') }}</span>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex justify-between mt-8">
            <a href="{{ route('positions.index') }}"
               class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition">
                ← Kembali
            </a>
            <a href="{{ route('positions.edit', $position->id) }}"
               class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:opacity-90 transition">
                Edit Jabatan
            </a>
        </div>
    </div>
@endsection
