@extends('layouts.app')

@section('title', 'The Comp | Attendance Details')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">
            Detail Kehadiran
        </h1>

        <!-- Container Utama Bento: 2 Kolom di Desktop -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Kolom Kiri: Detail Kehadiran (Minimalist Cards) -->
            <div class="space-y-6">

                <!-- Card 1: Detail Pegawai & Tanggal -->
                <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-3 border-gray-100">
                        {{ $attendance->employee->fullname ?? 'Pegawai Dihapus' }}
                    </h3>

                    <div class="space-y-4 text-sm">
                        {{-- Nama Pegawai --}}
                        <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                            <span class="font-medium text-gray-500">Pegawai</span>
                            <span class="text-gray-900 font-semibold">{{ $attendance->employee->fullname ?? '-' }}</span>
                        </p>

                        {{-- Tanggal --}}
                        <p class="flex justify-between">
                            <span class="font-medium text-gray-500">Tanggal</span>
                            <span class="text-gray-900 font-semibold">{{ $attendance->date }}</span>
                        </p>
                    </div>
                </div>

                <!-- Card 2: Detail Waktu & Status -->
                <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-3 border-gray-100">Waktu & Status</h3>

                    <div class="space-y-4 text-sm">
                        {{-- Check In --}}
                        <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                            <span class="font-medium text-gray-500">Check In</span>
                            <span class="text-gray-900">{{ $attendance->check_in ?? '-' }}</span>
                        </p>

                        {{-- Check Out --}}
                        <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                            <span class="font-medium text-gray-500">Check Out</span>
                            <span class="text-gray-900">{{ $attendance->check_out ?? '-' }}</span>
                        </p>

                        {{-- Status --}}
                        <div class="flex justify-between items-center pt-2">
                            <span class="font-medium text-gray-500">Status</span>

                            <!-- Status Badge Monokrom -->
                            @php
                                $statusClasses = match ($attendance->status) {
                                    'present' => 'bg-gray-200 text-gray-800 ring-gray-400', // Hadir
                                    'sick' => 'bg-gray-700 text-white ring-gray-500', // Sakit (Abu-abu gelap)
                                    'permission'
                                        => 'bg-gray-100 text-gray-700 ring-gray-300', // Izin (Abu-abu sangat terang)
                                    default => 'bg-gray-900 text-white ring-gray-600', // Alpha/Lainnya (Hitam)
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-sm font-medium ring-1 {{ $statusClasses }}">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </div>
                    </div>
                </div>


                <!-- Action Buttons (di bawah kolom detail) -->
                <div class="flex justify-between gap-4 pt-2">
                    <a href="{{ route('attendances.index') }}"
                        class="flex-1 text-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition font-semibold">
                        ← Back
                    </a>
                    <a href="{{ route('attendances.edit', $attendance->id) }}"
                        class="flex-1 text-center bg-gray-900 text-white px-6 py-3 rounded-xl shadow hover:bg-gray-700 transition font-semibold">
                        Edit Record
                    </a>
                </div>
            </div>

            <!-- Kolom Kanan: Container Gambar -->
            <div class="hidden md:block">
                <div class="bg-gray-900 rounded-2xl h-full shadow-xl overflow-hidden border border-gray-200">
                    <!-- Container Gambar, diisi dengan gambar/ilustrasi monokrom -->
                    <img src="https://i.pinimg.com/736x/ab/b3/5a/abb35a4d6a30958658b44b5e544677af.jpg" alt="Ilustrasi Detail Kehadiran"
                        class="w-full h-full object-cover opacity-70">
                </div>
            </div>
        </div>
    </div>
@endsection
