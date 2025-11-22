@extends('layouts.app')

@section('title', 'The Comp | Attendance')

@section('content')
    <div class="mb-8 container mx-auto px-4">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <h2 class="text-3xl font-extrabold text-gray-900">
                Daftar Kehadiran
            </h2>
            <div class="flex space-x-3 justify-center items-center">
                <a href="/"
                    class="inline-flex items-center gap-2 bg-white border border-gray-400 text-gray-800 px-5 py-2 rounded-xl shadow hover:bg-gray-100 transition font-semibold text-sm">
                    ← Back to the Main
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        @if ($attendances->isEmpty())
            <div class="bg-white p-8 rounded-2xl shadow-xl text-center border border-gray-200">
                <p class="text-gray-500 font-medium">Tidak ada data kehadiran yang tersedia.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                @foreach ($attendances as $attendance)
                    <div
                        class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6 flex flex-col transition-all hover:shadow-2xl hover:border-gray-400/50">

                        <div class="flex justify-between items-start mb-4 border-b pb-3 border-gray-100">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 leading-snug">
                                    {{ $attendance->employee->fullname ?? 'Pegawai Dihapus' }}
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">Tanggal: {{ $attendance->date }}</p>
                            </div>

                            @php
                                $statusClasses = match($attendance->status) {
                                    'present' => 'bg-gray-200 text-gray-800 ring-gray-400', // Hadir
                                    'sick' => 'bg-gray-700 text-white ring-gray-500', // Sakit (Abu-abu gelap)
                                    'permission' => 'bg-gray-100 text-gray-700 ring-gray-300', // Izin (Abu-abu sangat terang)
                                    default => 'bg-gray-900 text-white ring-gray-600', // Alpha/Lainnya (Hitam)
                                };
                            @endphp
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold shadow-sm ring-1 {{ $statusClasses }}">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </div>

                        <div class="space-y-3 text-sm flex-grow mb-6">
                            <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                                <span class="text-gray-500 font-semibold">Check In:</span>
                                <span class="text-gray-900">{{ $attendance->check_in ?? '—' }}</span>
                            </p>
                            <p class="flex justify-between">
                                <span class="text-gray-500 font-semibold">Check Out:</span>
                                <span class="text-gray-900">{{ $attendance->check_out ?? '—' }}</span>
                            </p>
                        </div>

                        <div class="flex gap-2 pt-3 border-t border-gray-100">

                            <a href="{{ route('attendances.show', $attendance->id) }}"
                                class="flex-1 text-center px-2 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 text-sm font-medium transition">
                                Detail
                            </a>

                            <a href="{{ route('attendances.edit', $attendance->id) }}"
                                class="flex-1 text-center px-2 py-2 bg-gray-900 text-white rounded-xl hover:bg-gray-700 text-sm font-medium transition">
                                Edit
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Pagination Links --}}
        <div class="mt-8">
            {{ $attendances->links() }}
        </div>
    </div>
@endsection
