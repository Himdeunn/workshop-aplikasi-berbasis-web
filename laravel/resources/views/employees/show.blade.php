@extends('layouts.app')

@section('title', 'The Comp | Detail Employee')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1
            class="text-4xl font-extrabold mb-10 text-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            Detail Pegawai
        </h1>

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 space-y-6">
            {{-- Nama Lengkap --}}
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-semibold text-gray-600">Nama Lengkap</span>
                <span class="text-gray-900">{{ $employee->fullname }}</span>
            </div>

            {{-- Email --}}
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-semibold text-gray-600">Email</span>
                <span class="text-gray-900">{{ $employee->email }}</span>
            </div>

            {{-- Department --}}
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-semibold text-gray-600">Department</span>
                <span class="text-gray-900">
                    {{ $employee->department->department_name ?? '—' }}
                </span>
            </div>

            {{-- Position --}}
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-semibold text-gray-600">Position</span>
                <span class="text-gray-900">
                    {{ $employee->position->position_name ?? '—' }}
                </span>
            </div>

            {{-- Nomor Telepon --}}
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-semibold text-gray-600">Nomor Telepon</span>
                <span class="text-gray-900">{{ $employee->phone_number }}</span>
            </div>

            {{-- Tanggal Lahir --}}
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-semibold text-gray-600">Tanggal Lahir</span>
                <span class="text-gray-900">{{ $employee->birth_date }}</span>
            </div>

            {{-- Alamat --}}
            <div class="flex justify-between items-start border-b pb-3">
                <span class="font-semibold text-gray-600">Alamat</span>
                <span class="text-gray-900 text-right w-2/3 break-words">
                    {{ $employee->address }}
                </span>
            </div>

            {{-- Tanggal Masuk --}}
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-semibold text-gray-600">Tanggal Masuk</span>
                <span class="text-gray-900">{{ $employee->date_entry }}</span>
            </div>

            {{-- Status --}}
            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-600">Status</span>
                <span
                    class="px-3 py-1 rounded-full text-sm font-medium
                    {{ $employee->status === 'active'
                        ? 'bg-green-100 text-green-700 ring-1 ring-green-300'
                        : 'bg-red-100 text-red-700 ring-1 ring-red-300' }}">
                    {{ ucfirst($employee->status) }}
                </span>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex justify-between mt-8">
            <a href="{{ route('employees.index') }}"
                class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition">
                ← Kembali
            </a>
            <a href="{{ route('employees.edit', $employee->id) }}"
                class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:opacity-90 transition">
                Edit Pegawai
            </a>
        </div>
    </div>
@endsection
