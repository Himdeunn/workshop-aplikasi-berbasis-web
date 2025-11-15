@extends('layouts.app')

@section('title', 'The Comp | Add Attendance Record')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-4xl font-extrabold mb-10 text-center bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
        Add Attendance
    </h1>

    <form action="{{ route('attendances.store') }}" method="POST"
          class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 space-y-6">
        @csrf

        {{-- Employee --}}
        <div>
            <label for="employee_id" class="block font-semibold text-gray-700 mb-2">Employee</label>
            <select id="employee_id" name="employee_id"
                    class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                <option value="">-- Select Employee --</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->fullname }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Date --}}
        <div>
            <label for="date" class="block font-semibold text-gray-700 mb-2">Date</label>
            <input type="date" id="date" name="date"
                   value="{{ old('date') }}"
                   class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
        </div>

        {{-- Check In --}}
        <div>
            <label for="check_in" class="block font-semibold text-gray-700 mb-2">Check In (Time)</label>
            <input type="time" id="check_in" name="check_in"
                   value="{{ old('check_in') }}"
                   class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
        </div>

        {{-- Check Out --}}
        <div>
            <label for="check_out" class="block font-semibold text-gray-700 mb-2">Check Out (Time)</label>
            <input type="time" id="check_out" name="check_out"
                   value="{{ old('check_out') }}"
                   class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block font-semibold text-gray-700 mb-2">Status</label>
            <select id="status" name="status"
                    class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Present</option>
                <option value="sick" {{ old('status') == 'sick' ? 'selected' : '' }}>Sick</option>
                <option value="permission" {{ old('status') == 'permission' ? 'selected' : '' }}>Permission</option>
                <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent</option>
            </select>
        </div>

        {{-- Buttons --}}
        <div class="flex justify-between mt-8">
            <a href="{{ route('attendances.index') }}"
               class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition">
                ← Back
            </a>
            <button type="submit"
                    class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-8 py-3 rounded-xl shadow hover:opacity-90 transition">
                Save Attendance
            </button>
        </div>
    </form>
</div>
@endsection
