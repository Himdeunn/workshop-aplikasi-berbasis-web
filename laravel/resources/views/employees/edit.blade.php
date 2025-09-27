@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1
            class="text-4xl font-extrabold mb-10 text-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            Edit Pegawai
        </h1>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST"
              class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 space-y-6">
            @csrf
            @method('PUT')

            {{-- Nama Lengkap --}}
            <div>
                <label for="fullname" class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" id="fullname" name="fullname"
                       value="{{ old('fullname', $employee->fullname) }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email', $employee->email) }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            {{-- Nomor Telepon --}}
            <div>
                <label for="phone_number" class="block font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                <input type="text" id="phone_number" name="phone_number"
                       value="{{ old('phone_number', $employee->phone_number) }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label for="birth_date" class="block font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                <input type="date" id="birth_date" name="birth_date"
                       value="{{ old('birth_date', $employee->birth_date) }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            {{-- Alamat --}}
            <div>
                <label for="address" class="block font-semibold text-gray-700 mb-2">Alamat</label>
                <textarea id="address" name="address" rows="3"
                          class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('address', $employee->address) }}</textarea>
            </div>

            {{-- Tanggal Masuk --}}
            <div>
                <label for="date_entry" class="block font-semibold text-gray-700 mb-2">Tanggal Masuk</label>
                <input type="date" id="date_entry" name="date_entry"
                       value="{{ old('date_entry', $employee->date_entry) }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block font-semibold text-gray-700 mb-2">Status</label>
                <select id="status" name="status"
                        class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="active" {{ old('status', $employee->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="non-active" {{ old('status', $employee->status) === 'non-active' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-between mt-8">
                <a href="{{ route('employees.index') }}"
                   class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition">
                    ← Kembali
                </a>
                <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:opacity-90 transition">
                    Update Pegawai
                </button>
            </div>
        </form>
    </div>
@endsection
