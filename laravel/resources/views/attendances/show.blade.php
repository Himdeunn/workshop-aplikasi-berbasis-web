@extends('layouts.app')

@section('title', 'The Comp | Attendance Details')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-4xl font-extrabold mb-10 text-center bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
        Attendance Details
    </h1>

    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 space-y-6">
        <div class="flex justify-between border-b pb-3">
            <span class="font-semibold text-gray-600">Employee</span>
            <span class="text-gray-900">{{ $attendance->employee->fullname ?? '-' }}</span>
        </div>

        <div class="flex justify-between border-b pb-3">
            <span class="font-semibold text-gray-600">Date</span>
            <span class="text-gray-900">{{ $attendance->date }}</span>
        </div>

        <div class="flex justify-between border-b pb-3">
            <span class="font-semibold text-gray-600">Check In</span>
            <span class="text-gray-900">{{ $attendance->check_in ?? '-' }}</span>
        </div>

        <div class="flex justify-between border-b pb-3">
            <span class="font-semibold text-gray-600">Check Out</span>
            <span class="text-gray-900">{{ $attendance->check_out ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center">
            <span class="font-semibold text-gray-600">Status</span>
            <span class="px-3 py-1 rounded-full text-sm font-medium
                @if($attendance->status === 'present')
                    bg-green-100 text-green-700
                @elseif($attendance->status === 'sick')
                    bg-yellow-100 text-yellow-700
                @elseif($attendance->status === 'permission')
                    bg-blue-100 text-blue-700
                @else
                    bg-red-100 text-red-700
                @endif">
                {{ ucfirst($attendance->status) }}
            </span>
        </div>
    </div>

    <div class="flex justify-between mt-8">
        <a href="{{ route('attendances.index') }}"
           class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition">
            ← Back
        </a>
        <a href="{{ route('attendances.edit', $attendance->id) }}"
           class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl shadow hover:opacity-90 transition">
            Edit Record
        </a>
    </div>
</div>
@endsection
