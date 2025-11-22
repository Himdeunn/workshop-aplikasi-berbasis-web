@extends('layouts.app')

@section('title', 'The Comp | Attendance Record')

@section('content')
    <div>
        <!-- Header -->
        <div
            class="max-w-7xl mx-auto mb-6 sm:mb-6 bg-gradient-to-br from-gray-900 to-gray-700 rounded-2xl shadow-2xl p-6 sm:p-8 border border-gray-800">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white">
                Attendance Overview
            </h1>
            <p class="text-sm sm:text-base text-gray-300 mt-1">
                Halo {{ auth()->user()->name }}, keep your presence on point 🚀
            </p>
        </div>

        <!-- Bento Grid Layout -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 auto-rows-auto">

            <!-- Card 1: Action Button - Tall on mobile, medium on desktop -->
            <div
                class="sm:col-span-1 lg:row-span-2 bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-xl p-6 sm:p-8 flex flex-col justify-center items-center text-white border border-gray-700">
                <div class="text-center w-full">
                    <div class="mb-4 sm:mb-6">
                        <div
                            class="w-16 h-16 sm:w-20 sm:h-20 mx-auto bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm border-2 border-white/20">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    <h3 class="text-lg sm:text-xl font-bold mb-2">Absensi Hari Ini</h3>
                    <p class="text-sm sm:text-base text-gray-400 mb-6">{{ date('d F Y') }}</p>

                    @if (!$today?->check_in)
                        <form action="{{ route('attendance.checkin') }}" method="POST" class="w-full">
                            @csrf
                            <button
                                class="w-full bg-white text-gray-900 hover:bg-gray-100 py-3 sm:py-4 rounded-xl font-bold shadow-lg transition-all transform hover:scale-105">
                                Check-in Sekarang
                            </button>
                        </form>
                    @elseif(!$today?->check_out)
                        <form action="{{ route('attendance.checkout') }}" method="POST" class="w-full">
                            @csrf
                            <button
                                class="w-full bg-white text-gray-900 hover:bg-gray-100 py-3 sm:py-4 rounded-xl font-bold shadow-lg transition-all transform hover:scale-105">
                                Check-out Sekarang
                            </button>
                        </form>
                    @else
                        <div
                            class="w-full bg-white/10 backdrop-blur-sm py-3 sm:py-4 rounded-xl font-bold border border-white/20">
                            Sudah Absen Hari Ini 🎉
                        </div>
                    @endif
                </div>
            </div>

            <!-- Card 2: Check-in Status -->
            <div
                class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200 hover:shadow-2xl hover:border-gray-900 transition-all">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 bg-gray-900 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-sm text-gray-500 font-medium mb-1 uppercase tracking-wide">Check-in Time</h3>
                <p class="text-2xl sm:text-3xl font-bold text-gray-900">
                    {{ $today?->check_in ? \Carbon\Carbon::parse($today->check_in)->format('H:i') : '--:--' }}
                </p>
                <p class="text-xs sm:text-sm text-gray-600 mt-2">
                    {{ $today?->check_in ? 'Tepat waktu ✨' : 'Belum check-in' }}
                </p>
            </div>

            <!-- Card 3: Check-out Status -->
            <div
                class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200 hover:shadow-2xl hover:border-gray-900 transition-all">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 bg-gray-700 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-sm text-gray-500 font-medium mb-1 uppercase tracking-wide">Check-out Time</h3>
                <p class="text-2xl sm:text-3xl font-bold text-gray-900">
                    {{ $today?->check_out ? \Carbon\Carbon::parse($today->check_out)->format('H:i') : '--:--' }}
                </p>
                <p class="text-xs sm:text-sm text-gray-600 mt-2">
                    {{ $today?->check_out ? 'Selesai untuk hari ini 👋' : 'Belum check-out' }}
                </p>
            </div>

            <!-- Card 4: Quick Stats -->
            <div
                class="sm:col-span-2 lg:col-span-1 bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-xl p-6 text-white border border-gray-700">
                <h3 class="text-base sm:text-lg font-bold mb-4">Statistik Bulan Ini</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-300">Total Hadir</span>
                        <span
                            class="text-xl sm:text-2xl font-bold">{{ $history->where('check_in', '!=', null)->where('check_out', '!=', null)->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-300">Belum Checkout</span>
                        <span
                            class="text-xl sm:text-2xl font-bold">{{ $history->where('check_in', '!=', null)->where('check_out', null)->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Card 5: Info Card -->
            <div
                class="sm:col-span-2 lg:col-span-3 bg-gradient-to-r from-gray-200 to-gray-300 rounded-2xl shadow-xl p-6 sm:p-8 text-gray-900 border-2 border-gray-400">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <div class="p-3 sm:p-4 bg-gray-900 rounded-2xl">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg sm:text-xl font-bold mb-2">Reminder</h3>
                        <p class="text-sm sm:text-base text-gray-700">
                            Pastikan kamu check-in & check-out tepat waktu untuk mencatat kehadiran dengan akurat. Absensi
                            yang lengkap membantu sistem bekerja lebih baik! ✨
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 6: History Table - Full Width -->
            <div class="sm:col-span-2 lg:col-span-4 bg-white rounded-2xl shadow-xl p-6 sm:p-8 border-2 border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-3">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Riwayat Kehadiran</h2>
                    <span class="text-sm text-gray-600 font-medium">Total: {{ $history->count() }} hari</span>
                </div>

                <div class="overflow-x-auto -mx-6 sm:mx-0">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden border border-gray-200 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-900">
                                    <tr>
                                        <th
                                            class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th
                                            class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                            Check-in
                                        </th>
                                        <th
                                            class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                            Check-out
                                        </th>
                                        <th
                                            class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($history as $item)
                                        <tr class="hover:bg-gray-100 transition-colors">
                                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                            </td>
                                            <td
                                                class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                                                {{ $item->check_in ? \Carbon\Carbon::parse($item->check_in)->format('H:i') : '-' }}
                                            </td>
                                            <td
                                                class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                                                {{ $item->check_out ? \Carbon\Carbon::parse($item->check_out)->format('H:i') : '-' }}
                                            </td>
                                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                                @if ($item->check_in && $item->check_out)
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-900 text-white border border-gray-900">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Hadir
                                                    </span>
                                                @elseif($item->check_in && !$item->check_out)
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-400 text-white border border-gray-400">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Belum Checkout
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white text-gray-900 border-2 border-gray-900">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Tidak Lengkap
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 sm:px-6 py-8 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <p class="text-gray-500 text-sm font-medium">Belum ada riwayat absensi
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
