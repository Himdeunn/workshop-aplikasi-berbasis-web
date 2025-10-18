@extends('layouts.app')

@section('title', 'The Comp | Welcome')

@section('content')
    <div class="max-w-3xl mx-auto text-center">
        {{-- Title --}}
        <h1 class="text-4xl font-extrabold mb-6 bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            Selamat Datang
        </h1>
        <p class="text-gray-600 text-lg">
            Ini adalah halaman utama aplikasi pegawai. Kelola data pegawai Anda dengan mudah dan cepat.
        </p>

        {{-- Action Button --}}
        <div class="mt-10 flex justify-center">
            <a href="{{ route('employees.index') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl hover:opacity-90 transition text-base font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M9 17v-6h13M9 5v6h13" />
                </svg>
                Check Your Employees
            </a>
        </div>
    </div>
@endsection
