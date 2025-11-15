@extends('layouts.app')

@section('title', 'The Comp | Create Position')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1
            class="text-4xl font-extrabold mb-10 text-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            Tambah Jabatan
        </h1>

        <form action="{{ route('positions.store') }}" method="POST"
              class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 space-y-6">
            @csrf

            {{-- Nama Jabatan --}}
            <div>
                <label for="position_name" class="block font-semibold text-gray-700 mb-2">Nama Jabatan</label>
                <input type="text" id="position_name" name="position_name"
                       value="{{ old('position_name') }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                       placeholder="Masukkan nama jabatan">
            </div>

            {{-- Gaji Pokok --}}
            <div>
                <label for="base_salary" class="block font-semibold text-gray-700 mb-2">Gaji Pokok</label>
                <input type="number" id="base_salary" name="base_salary"
                       value="{{ old('base_salary') }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                       placeholder="Masukkan gaji pokok">
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-between mt-8">
                <a href="{{ route('positions.index') }}"
                   class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition">
                    ← Kembali
                </a>
                <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-xl shadow hover:opacity-90 transition">
                    Simpan Jabatan
                </button>
            </div>
        </form>
    </div>
@endsection
