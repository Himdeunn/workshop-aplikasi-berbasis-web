@extends('layouts.app')

@section('title', 'The Comp | Department')

@section('content')
    <div class="mb-8 container mx-auto px-4">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <!-- Header dan Tombol - Monokrom -->
            <h2 class="text-3xl font-extrabold text-gray-900">
                Daftar Departemen
            </h2>
            <div class="flex space-x-3 justify-center items-center">
                <a href="{{ route('departments.create') }}"
                    class="inline-flex items-center gap-2 bg-gray-900 text-white px-5 py-2 rounded-xl shadow hover:bg-gray-700 transition font-semibold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Departemen
                </a>
                <a href="/"
                    class="inline-flex items-center gap-2 bg-white border border-gray-400 text-gray-800 px-5 py-2 rounded-xl shadow hover:bg-gray-100 transition font-semibold text-sm">
                    ← Back to the Main
                </a>
            </div>
        </div>
    </div>

    <!-- Area Konten Utama: Bento Grid -->
    <div class="container mx-auto px-4">
        @if ($departments->isEmpty())
            <!-- Kondisi jika tidak ada data -->
            <div class="bg-white p-8 rounded-2xl shadow-xl text-center border border-gray-200">
                <p class="text-gray-500 font-medium">Tidak ada data departemen yang tersedia.</p>
            </div>
        @else
            <!-- GRID: Layout Bento Responsif (3 Kolom) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($departments as $department)
                    <!-- Card Departemen Minimalis -->
                    <div
                        class="bg-white rounded-2xl shadow-xl border border-gray-200 p-5 flex flex-col transition-all hover:shadow-2xl hover:border-gray-400/50">

                        <!-- Nama Departemen -->
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex-grow">
                            {{ $department->department_name }}
                        </h3>

                        <!-- Aksi Card (Footer Card) - Semua tombol memiliki ukuran yang sama menggunakan flex-1 -->
                        <div class="flex gap-2 pt-3 border-t border-gray-100">

                            <!-- Detail Monokrom (flex-1) -->
                            <a href="{{ route('departments.show', $department->id) }}"
                                class="flex-1 text-center px-2 py-1 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-xs font-medium transition">
                                Detail
                            </a>

                            <!-- Edit Monokrom (flex-1) -->
                            <a href="{{ route('departments.edit', $department->id) }}"
                                class="flex-1 text-center px-2 py-1 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-xs font-medium transition">
                                Edit
                            </a>

                            <!-- Delete Monokrom (Form menggunakan flex-1) -->
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus departemen ini?')" class="flex-1">
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
    </div>
@endsection
