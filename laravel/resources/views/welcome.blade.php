@extends('layouts.app')

@section('title', 'The Comp | Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">
            Selamat Datang di App Pegawai
        </h1>

        @guest
            {{-- ===================================
            | 1. GUEST USER (Pengunjung)
            =================================== --}}
            <div class="text-center max-w-2xl mx-auto p-12 bg-white shadow-xl rounded-2xl border border-gray-200">
                <p class="text-gray-700 text-xl mb-6 font-semibold">
                    Akses penuh ke sistem hanya tersedia untuk pengguna yang terdaftar.
                </p>
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('login') }}"
                        class="px-8 py-3 rounded-xl bg-gray-900 text-white font-semibold hover:bg-gray-700 transition shadow-lg">
                        Login Sekarang
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-8 py-3 rounded-xl border border-gray-900 text-gray-900 font-semibold hover:bg-gray-100 transition shadow-lg">
                        Daftar Akun Baru
                    </a>
                </div>
            </div>

        @endguest

        @auth
            {{-- Tampilkan nama dan peran pengguna --}}
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">
                Dashboard {{ ucfirst(auth()->user()->role) }}
            </h2>

            {{-- ===================================
            | 2. ADMIN USER (Bento Layout)
            =================================== --}}
            @if (auth()->user()->role === 'admin')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">

                    <a href="{{ route('employees.index') }}"
                        class="col-span-1 md:col-span-2 lg:col-span-1 bg-gray-900 text-white shadow-xl rounded-2xl p-6 hover:shadow-2xl hover:opacity-95 transition flex flex-col justify-between">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-4 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-3m-6-11h5V6m-1-5H6a2 2 0 00-2 2v14a2 2 0 002 2h10l1 1h4l1-1v-4M8 12h4m-4 4h4" />
                            </svg>
                            <h3 class="text-2xl font-bold mb-1">Kelola Pegawai</h3>
                            <p class="text-sm opacity-80">Lihat, edit, dan hapus data pegawai yang ada.</p>
                        </div>
                        <span class="mt-4 text-sm font-semibold border-b border-white/50 w-fit">Lihat Detail →</span>
                    </a>

                    <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200 col-span-1 flex flex-col justify-between">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Struktur Organisasi</h3>
                            <p class="text-sm text-gray-600 mb-4">Atur dan kelola departemen dan jabatan perusahaan.</p>
                        </div>

                        <div class="flex gap-3 pt-4 border-t border-gray-100">

                            <a href="{{ route('departments.index') }}"
                                class="flex-1 text-center text-sm font-semibold px-4 py-2 rounded-xl bg-gray-900 text-white hover:bg-gray-700 transition">
                                Departemen
                            </a>

                            <a href="{{ route('positions.index') }}"
                                class="flex-1 text-center text-sm font-semibold px-4 py-2 rounded-xl bg-gray-900 text-white hover:bg-gray-700 transition">
                                Jabatan
                            </a>

                        </div>
                    </div>

                    <a href="{{ route('attendances.index') }}"
                        class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200 col-span-1 hover:shadow-2xl hover:bg-gray-50 transition flex flex-col justify-between">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Laporan Kehadiran</h3>
                            <p class="text-sm text-gray-600">Lihat ringkasan dan detail absensi pegawai.</p>
                        </div>
                        <span class="mt-4 text-sm font-semibold text-gray-700 border-b border-gray-400 w-fit">Lihat Laporan →</span>
                    </a>
                </div>
            @endif


            {{-- ===================================
            | 3. EMPLOYEE USER (Bento Layout)
            =================================== --}}
            @if (auth()->user()->role === 'employee')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">

                    <a href="{{ route('attendance.absence') }}"
                        class="bg-gray-900 text-white shadow-xl rounded-2xl p-8 hover:shadow-2xl hover:opacity-95 transition flex flex-col justify-between">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-4 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-3xl font-bold mb-1">Lakukan Absensi</h3>
                            <p class="text-base opacity-80">Check-in atau Check-out Anda untuk hari ini.</p>
                        </div>
                        <span class="mt-6 text-sm font-semibold border-b border-white/50 w-fit">Mulai Absensi →</span>
                    </a>

                    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200 flex flex-col justify-between">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-700 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Riwayat Saya</h3>
                            <p class="text-sm text-gray-600">Lihat profil dan rekam jejak kehadiran Anda.</p>
                        </div>
                        <a href="{{ url('/') }}" class="mt-6 text-sm font-semibold text-gray-700 border-b border-gray-400 w-fit hover:text-gray-900 transition">
                            Lihat Profil & Riwayat →
                        </a>
                    </div>
                </div>
            @endif
        @endauth
    </div>
@endsection
