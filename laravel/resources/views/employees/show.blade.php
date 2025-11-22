@extends('layouts.app')

@section('title', 'The Comp | Detail Employee')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">
            Detail Pegawai
        </h1>

        <!-- Container Utama Bento: 2 Kolom di Desktop -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Kolom Kiri: Detail Pegawai (Multiple Cards) -->
            <div class="space-y-6">

                <!-- Card 1: Data Utama & Status -->
                <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
                    <div class="flex justify-between items-start mb-4 border-b pb-3 border-gray-100">
                        <div>
                            <p class="text-xl font-bold text-gray-900 leading-tight">
                                {{ $employee->fullname }}
                            </p>
                            <p class="text-sm text-gray-600 mt-1">{{ $employee->email }}</p>
                        </div>

                        <!-- Status Badge Monokrom -->
                        @php
                            $statusClasses =
                                $employee->status === 'active'
                                    ? 'bg-gray-200 text-gray-800 ring-gray-400'
                                    : 'bg-gray-800 text-white ring-gray-600';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-semibold shadow-sm ring-1 {{ $statusClasses }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </div>

                    <!-- Detail Card Utama -->
                    <div class="space-y-4 text-sm">
                        <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                            <span class="text-gray-500">Department:</span>
                            <span
                                class="font-medium text-gray-800">{{ $employee->department->department_name ?? '—' }}</span>
                        </p>
                        <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                            <span class="text-gray-500">Position:</span>
                            <span class="font-medium text-gray-800">{{ $employee->position->position_name ?? '—' }}</span>
                        </p>
                        <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                            <span class="text-gray-500">Tanggal Masuk:</span>
                            <span class="font-medium text-gray-800">{{ $employee->date_entry }}</span>
                        </p>
                    </div>
                </div>

                <!-- Card 2: Informasi Pribadi & Kontak -->
                <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2 border-gray-100">Kontak & Pribadi</h3>
                    <div class="space-y-4 text-sm">
                        <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                            <span class="text-gray-500">Nomor Telepon:</span>
                            <span class="font-medium text-gray-800">{{ $employee->phone_number }}</span>
                        </p>
                        <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                            <span class="text-gray-500">Tanggal Lahir:</span>
                            <span class="font-medium text-gray-800">{{ $employee->birth_date }}</span>
                        </p>
                        <div class="flex flex-col pt-2">
                            <span class="font-medium text-gray-500 mb-1">Alamat:</span>
                            <span class="text-gray-900 break-words mt-1">{{ $employee->address }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons (di bawah kolom detail) -->
                <div class="flex justify-between gap-4 pt-2">
                    <a href="{{ route('employees.index') }}"
                        class="flex-1 text-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition font-semibold">
                        ← Kembali
                    </a>
                    <a href="{{ route('employees.edit', $employee->id) }}"
                        class="flex-1 text-center bg-gray-900 text-white px-6 py-3 rounded-xl shadow hover:bg-gray-700 transition font-semibold">
                        Edit Pegawai
                    </a>
                </div>
            </div>
            <!-- Kolom Kanan: Container Gambar -->
            <div class="hidden md:block">
                <div class="bg-gray-900 rounded-2xl h-full shadow-xl overflow-hidden border border-gray-200">
                    <!-- Container Gambar, diisi dengan gambar/ilustrasi monokrom -->
                    <img src="https://i.pinimg.com/736x/1e/2b/ad/1e2badb18a288d866fe46ba9a7a7c920.jpg" alt="Ilustrasi Pegawai"
                        class="w-full h-full object-cover opacity-70">
                    <!-- Anda dapat menggunakan SVG monokrom di sini jika tidak menggunakan URL -->
                </div>
            </div>

        </div>
    </div>
@endsection
