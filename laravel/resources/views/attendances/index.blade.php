@extends('layouts.app')

@section('title', 'The Comp | Attendance')

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-extrabold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
            Daftar Kehadiran
        </h2>
        <div class="flex space-x-5 justify-center items-center">
            <a href="{{ route('attendances.create') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white px-5 py-2 rounded-lg shadow hover:shadow-lg hover:opacity-90 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kehadiran
            </a>
        </div>
    </div>
</div>

<div class="overflow-hidden bg-white shadow-xl rounded-2xl border border-gray-200">
    <table class="w-full text-sm text-left border-collapse">
        <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 uppercase text-xs tracking-wider">
            <tr>
                <th class="px-6 py-3">Nama Pegawai</th>
                <th class="px-6 py-3">Tanggal</th>
                <th class="px-6 py-3">Masuk</th>
                <th class="px-6 py-3">Keluar</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($attendances as $attendance)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $attendance->employee->fullname ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $attendance->date }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $attendance->check_in ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $attendance->check_out ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                            @if($attendance->status === 'present')
                                bg-green-100 text-green-700 ring-1 ring-green-300
                            @elseif($attendance->status === 'sick')
                                bg-yellow-100 text-yellow-700 ring-1 ring-yellow-300
                            @elseif($attendance->status === 'permission')
                                bg-blue-100 text-blue-700 ring-1 ring-blue-300
                            @else
                                bg-red-100 text-red-700 ring-1 ring-red-300
                            @endif">
                            {{ ucfirst($attendance->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                        <a href="{{ route('attendances.show', $attendance->id) }}"
                            class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 text-xs font-medium transition">
                            Detail
                        </a>
                        <a href="{{ route('attendances.edit', $attendance->id) }}"
                            class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 text-xs font-medium transition">
                            Edit
                        </a>
                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 text-xs font-medium transition">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
