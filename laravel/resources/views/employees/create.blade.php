@extends('layouts.app')

@section('title', 'The Comp | Add Employee')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1
            class="text-4xl font-extrabold mb-10 text-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            Tambah Pegawai
        </h1>

        <form action="{{ route('employees.store') }}" method="POST"
              class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 space-y-6">
            @csrf

            {{-- Nama Lengkap --}}
            <div>
                <label for="fullname" class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" id="fullname" name="fullname"
                       value="{{ old('fullname') }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            {{-- Nomor Telepon --}}
            <div>
                <label for="phone_number" class="block font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                <input type="text" id="phone_number" name="phone_number"
                       value="{{ old('phone_number') }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            {{-- Department --}}
            <div>
                <label for="department_id" class="block font-semibold text-gray-700 mb-2">Department</label>
                <select id="department_id" name="department_id"
                        class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="">-- Pilih Department --</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}"
                            {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->department_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Position --}}
            <div>
                <label for="position_id" class="block font-semibold text-gray-700 mb-2">Position</label>
                <select id="position_id" name="position_id"
                        class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="">-- Pilih Position --</option>
                    @foreach ($positions as $pos)
                        <option value="{{ $pos->id }}"
                            {{ old('position_id') == $pos->id ? 'selected' : '' }}>
                            {{ $pos->position_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label for="birth_date" class="block font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                <input type="date" id="birth_date" name="birth_date"
                       value="{{ old('birth_date') }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            {{-- Alamat --}}
            <div>
                <label for="address" class="block font-semibold text-gray-700 mb-2">Alamat</label>
                <textarea id="address" name="address" rows="3"
                          class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('address') }}</textarea>
            </div>

            {{-- Tanggal Masuk --}}
            <div>
                <label for="date_entry" class="block font-semibold text-gray-700 mb-2">Tanggal Masuk</label>
                <input type="date" id="date_entry" name="date_entry"
                       value="{{ old('date_entry') }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block font-semibold text-gray-700 mb-2">Status</label>
                <select id="status" name="status"
                        class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="non-active" {{ old('status') === 'non-active' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-between mt-8">
                <a href="{{ route('employees.index') }}"
                   class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition">
                    ← Kembali
                </a>
                <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-xl shadow hover:opacity-90 transition">
                    Simpan Pegawai
                </button>
            </div>
        </form>
    </div>
@endsection
