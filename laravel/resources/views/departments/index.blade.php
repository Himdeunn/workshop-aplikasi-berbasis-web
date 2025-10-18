@extends('layouts.app')

@section('title', 'The Comp | Department')

@section('content')
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                Daftar Departemen
            </h2>
            <div class="flex space-x-5 justify-center items-center">
                <a href="{{ route('departments.create') }}"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-5 py-2 rounded-lg shadow hover:shadow-lg hover:opacity-90 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Departemen
                </a>
                <a href="/"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-5 py-2 rounded-lg shadow hover:shadow-lg hover:opacity-90 transition">
                    ← Back to the Main
                </a>
            </div>
        </div>
    </div>

    <div class="overflow-hidden bg-white shadow-xl rounded-2xl border border-gray-200">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3">Nama Departemen</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($departments as $department)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $department->department_name }}</td>
                        <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                            <a href="{{ route('departments.show', $department->id) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 text-xs font-medium transition">
                                Detail
                            </a>
                            <a href="{{ route('departments.edit', $department->id) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 text-xs font-medium transition">
                                Edit
                            </a>
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus departemen ini?')">
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
