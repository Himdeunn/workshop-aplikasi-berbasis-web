@extends('layouts.app')

@section('title', 'The Comp | Edit Attendance Record')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">
            Edit Attendance
        </h1>

        <!-- Container Utama Bento: 2 Kolom di Desktop -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Kolom Kiri: Formulir Edit Attendance -->
            <form action="{{ route('attendances.update', $attendance->id) }}" method="POST"
                class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200 h-fit">
                @csrf
                @method('PUT')

                <!-- Grup Input: Dibagi 2 Kolom di Desktop untuk kerapian -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

                    {{-- Employee --}}
                    <div class="lg:col-span-2">
                        <label for="employee_id" class="block font-semibold text-gray-700 mb-2">Employee</label>
                        <select id="employee_id" name="employee_id"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                                focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ $attendance->employee_id == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Date --}}
                    <div>
                        <label for="date" class="block font-semibold text-gray-700 mb-2">Date</label>
                        <input type="date" id="date" name="date" value="{{ old('date', $attendance->date) }}"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                                focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="block font-semibold text-gray-700 mb-2">Status</label>
                        <select id="status" name="status"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                                focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                            <option value="present" {{ $attendance->status === 'present' ? 'selected' : '' }}>Present</option>
                            <option value="sick" {{ $attendance->status === 'sick' ? 'selected' : '' }}>Sick</option>
                            <option value="permission" {{ $attendance->status === 'permission' ? 'selected' : '' }}>Permission</option>
                            <option value="absent" {{ $attendance->status === 'absent' ? 'selected' : '' }}>Absent</option>
                        </select>
                    </div>

                    {{-- Check In --}}
                    <div>
                        <label for="check_in" class="block font-semibold text-gray-700 mb-2">Check In</label>
                        <input type="time" id="check_in" name="check_in"
                            value="{{ old('check_in', $attendance->check_in) }}"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                                focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                    </div>

                    {{-- Check Out --}}
                    <div>
                        <label for="check_out" class="block font-semibold text-gray-700 mb-2">Check Out</label>
                        <input type="time" id="check_out" name="check_out"
                            value="{{ old('check_out', $attendance->check_out) }}"
                            class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3
                                focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition">
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="flex justify-between gap-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('attendances.index') }}"
                        class="flex-1 text-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition font-semibold">
                        ← Back
                    </a>
                    <button type="submit"
                        class="flex-1 bg-gray-900 text-white px-8 py-3 rounded-xl shadow hover:bg-gray-700 transition font-semibold">
                        Update Attendance
                    </button>
                </div>
            </form>

            <!-- Kolom Kanan: Container Gambar -->
            <div class="hidden md:block">
                <div class="bg-gray-900 rounded-2xl h-full shadow-xl overflow-hidden border border-gray-200">
                    <!-- Container Gambar, diisi dengan gambar/ilustrasi monokrom -->
                    <img src="https://i.pinimg.com/736x/b8/ac/52/b8ac52edaf59a9799a3bc4522236feeb.jpg"
                         alt="Ilustrasi Edit Data Kehadiran"
                         class="w-full h-full object-cover opacity-70">
                </div>
            </div>

        </div>
    </div>
@endsection
