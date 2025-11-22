@extends('layouts.app')

@section('title', 'The Comp | Report Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">
            Laporan & Analisis Monokrom
        </h1>

        <!-- Tombol Aksi Global -->
        <div class="flex justify-end mb-8 flex-wrap gap-3">

            <a href="{{ route('report.export', ['type' => 'attendance']) }}"
                class="inline-flex items-center gap-2 bg-gray-900 text-white px-5 py-2 rounded-xl shadow hover:bg-gray-700 transition font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export Kehadiran
            </a>

            <a href="{{ route('report.export', ['type' => 'employees']) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-800 px-5 py-2 rounded-xl shadow border border-gray-400 hover:bg-gray-200 transition font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export Pegawai
            </a>

            <a href="{{ route('report.export', ['type' => 'positions']) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-800 px-5 py-2 rounded-xl shadow border border-gray-400 hover:bg-gray-200 transition font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M3 14h18m-9-4v4m-4-8v16M13 3v18" />
                </svg>
                Export Jabatan
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6">
            <div class="col-span-1 md:col-span-2 lg:col-span-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-gray-900 text-white shadow-xl rounded-2xl p-6 flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Total Pegawai</p>
                        <h3 class="text-4xl font-extrabold mt-1">{{ $totalEmployees }}</h3>
                    </div>
                </div>

                <div class="bg-gray-900 text-white shadow-xl rounded-2xl p-6 flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Total Departemen</p>
                        <h3 class="text-4xl font-extrabold mt-1">{{ $totalDepartments }}</h3>
                    </div>
                </div>

                <div class="bg-gray-900 text-white shadow-xl rounded-2xl p-6 flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Total Posisi</p>
                        <h3 class="text-4xl font-extrabold mt-1">{{ $totalPositions }}</h3> {{-- Menggunakan variabel baru --}}
                    </div>
                </div>
            </div>

            <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2 border-gray-100">Rata-Rata Gaji Pokok</h3>

                @php
                    $totalSalarySum = $salaryData->sum('base_salary');
                    $totalPositions = $salaryData->count();
                    $avgSalary = $totalPositions > 0 ? $totalSalarySum / $totalPositions : 0;
                    $formattedAvgSalary = 'Rp ' . number_format($avgSalary, 0, ',', '.');

                    $minSalary = $salaryData->min('base_salary') ?? 0;
                    $salaryDifference = $minSalary > 0 ? (($avgSalary - $minSalary) / $minSalary) * 100 : 0;
                @endphp

                <div class="flex flex-col space-y-4 pt-4">
                    <div class="text-center">
                        <p class="text-gray-500 text-sm">Rata-Rata Gaji per Jabatan</p>
                        <h4 class="text-4xl font-extrabold text-gray-900 mt-1">{{ $formattedAvgSalary }}</h4>
                    </div>

                    <div class="border-t border-gray-100 pt-4">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Statistik Perbandingan:</p>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600">Total Gaji Pokok (Sum):</span>
                            <span class="font-bold text-gray-800">Rp
                                {{ number_format($totalSalarySum, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm mt-2">
                            <span class="text-gray-600">Rata-rata di atas Min Gaji:</span>
                            <span class="font-bold {{ $salaryDifference >= 0 ? 'text-gray-800' : 'text-gray-500' }}">
                                {{ number_format($salaryDifference, 1) }}%
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2 border-gray-100">Tingkat Kehadiran Bulan Ini
                </h3>

                @php
                    $totalAttendanceRecords = $attendanceData->sum('total');
                    $presentCount = $attendanceData->where('status', 'present')->first()->total ?? 0;
                    $absentCount = $attendanceData->where('status', 'absent')->first()->total ?? 0;

                    $presentPercentage =
                        $totalAttendanceRecords > 0 ? ($presentCount / $totalAttendanceRecords) * 100 : 0;
                    $absentPercentage =
                        $totalAttendanceRecords > 0 ? ($absentCount / $totalAttendanceRecords) * 100 : 0;
                @endphp

                <div class="flex flex-col space-y-4 pt-4">
                    <div class="text-center">
                        <p class="text-gray-500 text-sm">Persentase Kehadiran (Present)</p>
                        <h4 class="text-6xl font-extrabold text-gray-900 mt-1">{{ number_format($presentPercentage, 1) }}%
                        </h4>
                    </div>

                    <div class="border-t border-gray-100 pt-4">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Rincian Absensi:</p>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600">Total Hadir (Present):</span>
                            <span class="font-bold text-gray-800">{{ $presentCount }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm mt-2">
                            <span class="text-gray-600">Total Tidak Hadir (Absent):</span>
                            <span class="font-bold text-gray-800">{{ $absentCount }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm mt-2">
                            <span class="text-gray-600">Total Cuti/Sakit (Others):</span>
                            <span
                                class="font-bold text-gray-800">{{ $totalAttendanceRecords - $presentCount - $absentCount }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1 md:col-span-4 lg:col-span-6 bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2 border-gray-100">Rincian Karyawan per
                    Departemen</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mt-4">
                    @foreach ($employeesByDept as $data)
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-100 text-center">
                            <p class="text-sm font-semibold text-gray-900 leading-tight">
                                {{ $data->department->department_name ?? 'N/A' }}</p>
                            <p class="text-3xl font-bold text-gray-700 mt-1">{{ $data->total }}</p>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('employees.index') }}"
                    class="mt-4 inline-block text-xs text-gray-500 hover:text-gray-900 border-b border-dashed">
                    Lihat Semua Data Pegawai →
                </a>
            </div>
        </div>
    </div>
@endsection
