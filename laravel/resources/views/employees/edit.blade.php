@extends('layouts.app')

@section('title', 'The Comp | Edit Employee')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">
            Edit Pegawai
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <form action="{{ route('employees.update', $employee->id) }}" method="POST"
                class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="fullname" class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="fullname" name="fullname"
                            value="{{ old('fullname', $employee->fullname) }}"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                            focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $employee->email) }}"
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

                    {{-- Department --}}
                    <div>
                        <label for="department_id" class="block font-semibold text-gray-700 mb-2">Department</label>
                        <select id="department_id" name="department_id"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                            focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                            <option value="">-- Pilih Department --</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}"
                                    {{ old('department_id', $employee->department_id) == $dept->id ? 'selected' : '' }}>
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
                            focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                            <option value="">-- Pilih Position --</option>
                            @foreach ($positions as $pos)
                                <option value="{{ $pos->id }}"
                                    {{ old('position_id', $employee->position_id) == $pos->id ? 'selected' : '' }}>
                                    {{ $pos->position_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label for="birth_date" class="block font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                        <input type="date" id="birth_date" name="birth_date"
                            value="{{ old('birth_date', $employee->birth_date) }}"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                            focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                    </div>

                    {{-- Tanggal Masuk --}}
                    <div>
                        <label for="date_entry" class="block font-semibold text-gray-700 mb-2">Tanggal Masuk</label>
                        <input type="date" id="date_entry" name="date_entry"
                            value="{{ old('date_entry', $employee->date_entry) }}"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                            focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="block font-semibold text-gray-700 mb-2">Status</label>
                        <select id="status" name="status"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                            focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                            <option value="active" {{ old('status', $employee->status) === 'active' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="non-active"
                                {{ old('status', $employee->status) === 'non-active' ? 'selected' : '' }}>
                                Nonaktif
                            </option>
                        </select>
                    </div>
                </div>

                {{-- Alamat (Full Width) --}}
                <div class="mb-8">
                    <label for="address" class="block font-semibold text-gray-700 mb-2">Alamat</label>
                    <textarea id="address" name="address" rows="3"
                        class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                        focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">{{ old('address', $employee->address) }}</textarea>
                </div>


                {{-- Action Buttons --}}
                <div class="flex justify-between gap-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('employees.index') }}"
                        class="flex-1 text-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition font-semibold">
                        ← Kembali
                    </a>
                    <button type="submit"
                        class="flex-1 bg-gray-900 text-white px-8 py-3 rounded-xl shadow hover:bg-gray-700 transition font-semibold">
                        Update Pegawai
                    </button>
                </div>
            </form>

            <div class="hidden md:block">
                <div class="bg-gray-900 rounded-2xl h-full shadow-xl overflow-hidden border border-gray-200">
                    <img src="https://i.pinimg.com/1200x/21/d4/51/21d45159d907997ca100928999bf221d.jpg" alt="Ilustrasi Edit Data Pegawai"
                        class="w-full h-full object-cover opacity-70">
                </div>
            </div>

        </div>
    </div>
@endsection
