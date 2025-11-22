@extends('layouts.app')

@section('title', 'The Comp | Employee')

@section('content')
    <div class="mb-8 container mx-auto px-4">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <h2 class="text-3xl font-extrabold text-gray-900">
                Daftar Pegawai
            </h2>
            <div class="flex space-x-3 justify-center items-center">
                <a href="/"
                    class="inline-flex items-center gap-2 bg-white border border-gray-400 text-gray-800 px-5 py-2 rounded-xl shadow hover:bg-gray-100 transition font-semibold text-sm">
                    ← Back to Main
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        @if ($employees->isEmpty())
            <div class="bg-white p-8 rounded-2xl shadow-xl text-center border border-gray-200">
                <p class="text-gray-500 font-medium">Tidak ada data pegawai yang tersedia.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                @foreach ($employees as $employee)
                    <div
                        class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6 flex flex-col transition-all hover:shadow-2xl hover:border-gray-400/50">

                        <div class="flex justify-between items-start mb-4 border-b pb-3 border-gray-100">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 leading-tight">
                                    {{ $employee->fullname }}
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">{{ $employee->email }}</p>
                            </div>

                            @php
                                $statusClasses = $employee->status === 'active'
                                    ? 'bg-gray-200 text-gray-800 ring-gray-400'
                                    : 'bg-gray-800 text-white ring-gray-600';
                            @endphp
                            <span
                                class="px-3 py-1 rounded-full text-[11px] font-semibold shadow-sm ring-1 {{ $statusClasses }}">
                                {{ ucfirst($employee->status) }}
                            </span>
                        </div>

                        <div class="space-y-2 text-sm flex-grow">
                            <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                                <span class="text-gray-500">Dept:</span>
                                <span
                                    class="font-medium text-gray-800">{{ $employee->department?->department_name ?? '—' }}</span>
                            </p>
                            <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                                <span class="text-gray-500">Posisi:</span>
                                <span
                                    class="font-medium text-gray-800">{{ $employee->position?->position_name ?? '—' }}</span>
                            </p>
                            <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                                <span class="text-gray-500">Telepon:</span>
                                <span class="font-medium text-gray-800">{{ $employee->phone_number }}</span>
                            </p>
                            <p class="flex justify-between border-b border-dashed border-gray-100 pb-1">
                                <span class="text-gray-500">Lahir:</span>
                                <span class="font-medium text-gray-800">
                                    {{ \Carbon\Carbon::parse($employee->birth_date)->format('d M Y') }}
                                </span>
                            </p>
                        </div>

                        <div class="flex gap-2 mt-5 pt-3 border-t border-gray-100">

                            <a href="{{ route('employees.show', $employee->id) }}"
                                class="flex-1 text-center px-2 py-1 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-xs font-medium transition">
                                Detail
                            </a>

                            <a href="{{ route('employees.edit', $employee->id) }}"
                                class="flex-1 text-center px-2 py-1 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-xs font-medium transition">
                                Edit
                            </a>

                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus pegawai ini?')"
                                class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full px-2 py-1 bg-gray-900 text-white rounded-lg hover:bg-gray-700 text-xs font-medium transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $employees->links() }}
        </div>
    </div>
@endsection
