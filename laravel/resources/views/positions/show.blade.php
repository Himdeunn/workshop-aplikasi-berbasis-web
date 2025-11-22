@extends('layouts.app')

@section('title', 'The Comp | Detail Position')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">
            Detail Jabatan
        </h1>

        <!-- Container Utama Bento: 2 Kolom di Desktop -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Kolom Kiri: Detail Jabatan (Minimalist Card) -->
            <div class="space-y-6">

                <!-- Card Detail Jabatan & Gaji -->
                <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-3 border-gray-100">
                        {{ $position->position_name }}
                    </h3>

                    <div class="space-y-4 text-sm">

                        {{-- Nama Jabatan --}}
                        <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                            <span class="font-medium text-gray-500">Nama Jabatan</span>
                            <span class="text-gray-900 font-semibold">{{ $position->position_name }}</span>
                        </p>

                        {{-- Gaji Pokok --}}
                        <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                            <span class="font-medium text-gray-500">Gaji Pokok</span>
                            <span class="text-gray-900 font-semibold">Rp {{ number_format($position->base_salary, 0, ',', '.') }}</span>
                        </p>
                    </div>
                </div>

                <!-- Card Detail Waktu (Bento Box Kecil) -->
                <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2 border-gray-100">Waktu Pencatatan</h3>
                    <div class="space-y-4 text-sm">
                        {{-- Created At --}}
                        <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                            <span class="font-medium text-gray-500">Dibuat Pada</span>
                            <span class="text-gray-900">{{ $position->created_at->format('d M Y') }}</span>
                        </p>

                        {{-- Updated At --}}
                        <p class="flex justify-between">
                            <span class="font-medium text-gray-500">Terakhir Diperbarui</span>
                            <span class="text-gray-900">{{ $position->updated_at->format('d M Y') }}</span>
                        </p>
                    </div>
                </div>

                <!-- Action Buttons (di bawah kolom detail) -->
                <div class="flex justify-between gap-4 pt-2">
                    <a href="{{ route('positions.index') }}"
                        class="flex-1 text-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition font-semibold">
                        ← Kembali
                    </a>
                    <a href="{{ route('positions.edit', $position->id) }}"
                        class="flex-1 text-center bg-gray-900 text-white px-6 py-3 rounded-xl shadow hover:bg-gray-700 transition font-semibold">
                        Edit Jabatan
                    </a>
                </div>
            </div>

            <!-- Kolom Kanan: Container Gambar -->
            <div class="hidden md:block">
                <div class="bg-gray-900 rounded-2xl h-full shadow-xl overflow-hidden border border-gray-200">
                    <!-- Container Gambar, diisi dengan gambar/ilustrasi monokrom -->
                    <img src="https://i.pinimg.com/1200x/76/f8/21/76f82158615f7f77694d2168eb731327.jpg"
                         alt="Ilustrasi Detail Jabatan Monokrom"
                         class="w-full h-full object-cover opacity-70">
                </div>
            </div>
        </div>
    </div>
@endsection
