@extends('layouts.app')

@section('title', 'The Comp | Create Department')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">
            Tambah Departemen
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <form action="{{ route('departments.store') }}" method="POST"
                class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200 h-fit">
                @csrf

                <div class="space-y-6">
                    {{-- Nama Departemen --}}
                    <div>
                        <label for="department_name" class="block font-semibold text-gray-700 mb-2">Nama Departemen</label>
                        <input type="text" id="department_name" name="department_name"
                            value="{{ old('department_name') }}"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                                focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition"
                            placeholder="Masukkan nama departemen">
                    </div>
                </div>

                <div class="flex justify-between gap-4 pt-8 border-t border-gray-100 mt-8">
                    <a href="{{ route('departments.index') }}"
                        class="flex-1 text-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition font-semibold">
                        ← Kembali
                    </a>
                    <button type="submit"
                        class="flex-1 bg-gray-900 text-white px-8 py-3 rounded-xl shadow hover:bg-gray-700 transition font-semibold">
                        Simpan Departemen
                    </button>
                </div>
            </form>

            <div class="hidden md:block">
                <div class="bg-gray-900 rounded-2xl h-full shadow-xl overflow-hidden border border-gray-200">
                    <img src="https://i.pinimg.com/736x/b7/f4/59/b7f459e7198d9828f5c4729df43f52ed.jpg"
                         alt="Ilustrasi Tambah Data Departemen"
                         class="w-full h-full object-cover opacity-70">
                </div>
            </div>

        </div>
    </div>
@endsection
