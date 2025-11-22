@extends('layouts.app')

@section('title', 'The Comp | Settings')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">
            Pengaturan Profil Pegawai
        </h1>

        @if (session('success'))
            <div class="bg-gray-200 text-gray-800 p-4 rounded-xl mb-6 border border-gray-400 max-w-4xl mx-auto">
                {{ session('success') }}
            </div>
        @endif

        <!-- Container Utama Bento: 2 Kolom di Desktop -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">

            <!-- Kolom Kiri: Formulir Edit Profil -->
            <form action="{{ route('settings.update') }}" method="POST"
                class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200 h-fit">
                @csrf
                @method('PUT')

                <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 border-gray-100">Informasi Pribadi</h3>

                <!-- Grup Input -->
                <div class="space-y-6">

                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="fullname" class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="fullname" name="fullname"
                            value="{{ old('fullname', $employee->fullname) }}" required
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                            focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $employee->email) }}"
                            required
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                            focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <label for="phone_number" class="block font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="text" id="phone_number" name="phone_number"
                            value="{{ old('phone_number', $employee->phone_number) }}"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                            focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label for="address" class="block font-semibold text-gray-700 mb-2">Alamat</label>
                        <textarea id="address" name="address" rows="3"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                            focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">{{ old('address', $employee->address) }}</textarea>
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end pt-8 border-t border-gray-200 mt-8">
                    <button type="submit"
                        class="bg-gray-900 text-white px-8 py-3 rounded-xl shadow hover:bg-gray-700 transition font-semibold">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

            <!-- Kolom Kanan: Container Gambar & Info -->
            <div class="hidden md:block">
                <div
                    class="bg-gray-900 text-white rounded-2xl h-full shadow-xl overflow-hidden border border-gray-200 p-8 flex flex-col justify-center">
                    <h4 class="text-xl font-bold mb-3">Data Kepegawaian</h4>
                    <div class="space-y-3 opacity-80">
                        <p class="flex justify-between border-b border-dashed border-gray-400/50 pb-1">
                            <span class="font-medium">Jabatan:</span>
                            <span>{{ $employee->position->position_name ?? 'N/A' }}</span>
                        </p>
                        <p class="flex justify-between border-b border-dashed border-gray-400/50 pb-1">
                            <span class="font-medium">Departemen:</span>
                            <span>{{ $employee->department->department_name ?? 'N/A' }}</span>
                        </p>
                        <p class="flex justify-between border-b border-dashed border-gray-400/50 pb-1">
                            <span class="font-medium">Tanggal Masuk:</span>
                            <span>{{ $employee->date_entry ?? 'N/A' }}</span>
                        </p>
                        <p class="flex justify-between">
                            <span class="font-medium">Status Akun:</span>
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-white text-gray-900">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
