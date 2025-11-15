@extends('layouts.app')

@section('title', 'The Comp | Detail Department')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-4xl font-extrabold mb-10 text-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            Detail Departemen
        </h1>

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 space-y-6">
            {{-- Nama Departemen --}}
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-semibold text-gray-600">Nama Departemen</span>
                <span class="text-gray-900">{{ $department->department_name }}</span>
            </div>

            {{-- Created At --}}
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-semibold text-gray-600">Dibuat Pada</span>
                <span class="text-gray-900">{{ $department->created_at->format('d M Y') }}</span>
            </div>

            {{-- Updated At --}}
            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-600">Terakhir Diperbarui</span>
                <span class="text-gray-900">{{ $department->updated_at->format('d M Y') }}</span>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex justify-between mt-8">
            <a href="{{ route('departments.index') }}"
               class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition">
                ← Kembali
            </a>
            <a href="{{ route('departments.edit', $department->id) }}"
               class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:opacity-90 transition">
                Edit Departemen
            </a>
        </div>
    </div>
@endsection
