@extends('layouts.app')

@section('title', 'The Comp | Edit Position')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">
            Edit Jabatan
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <form action="{{ route('positions.update', $position->id) }}" method="POST"
                class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200 h-fit">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    {{-- Nama Jabatan --}}
                    <div>
                        <label for="position_name" class="block font-semibold text-gray-700 mb-2">Nama Jabatan</label>
                        <input type="text" id="position_name" name="position_name"
                            value="{{ old('position_name', $position->position_name) }}"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                                focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                    </div>

                    {{-- Gaji Pokok --}}
                    <div>
                        <label for="base_salary" class="block font-semibold text-gray-700 mb-2">Gaji Pokok</label>
                        <input type="number" id="base_salary" name="base_salary"
                            value="{{ old('base_salary', $position->base_salary) }}"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                                focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                    </div>
                </div>

                <div class="flex justify-between gap-4 pt-8 border-t border-gray-100 mt-8">
                    <a href="{{ route('positions.index') }}"
                        class="flex-1 text-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition font-semibold">
                        ← Kembali
                    </a>
                    <button type="submit"
                        class="flex-1 bg-gray-900 text-white px-6 py-3 rounded-xl shadow hover:bg-gray-700 transition font-semibold">
                        Update Jabatan
                    </button>
                </div>
            </form>

            <div class="hidden md:block">
                <div class="bg-gray-900 rounded-2xl h-full shadow-xl overflow-hidden border border-gray-200">
                    <img src="https://i.pinimg.com/originals/24/ba/ee/24baee95217b413d6a9512f0309831b8.gif" alt="Ilustrasi Edit Data Jabatan"
                        class="w-full h-full object-cover opacity-70">
                </div>
            </div>

        </div>
    </div>
@endsection
