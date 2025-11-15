@extends('layouts.app')

@section('title', 'The Comp | Edit Department')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1
            class="text-4xl font-extrabold mb-10 text-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            Edit Departemen
        </h1>

        <form action="{{ route('departments.update', $department->id) }}" method="POST"
              class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 space-y-6">
            @csrf
            @method('PUT')

            {{-- Nama Departemen --}}
            <div>
                <label for="department_name" class="block font-semibold text-gray-700 mb-2">Nama Departemen</label>
                <input type="text" id="department_name" name="department_name"
                       value="{{ old('department_name', $department->department_name) }}"
                       class="w-full border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-between mt-8">
                <a href="{{ route('departments.index') }}"
                   class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition">
                    ← Kembali
                </a>
                <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:opacity-90 transition">
                    Update Departemen
                </button>
            </div>
        </form>
    </div>
@endsection
