@extends('layouts.app')

@section('title', 'The Comp | Login')

@section('content')
    {{-- Toast Notification (diimport di layouts.app) akan muncul di sini secara otomatis --}}

    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-8">

        <div
            class="w-full max-w-4xl bg-white shadow-lg rounded-xl overflow-hidden md:grid md:grid-cols-2 border border-gray-200">

            <div class="p-8 lg:p-12 flex flex-col justify-center">

                <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                    Login
                </h2>

                {{-- **DIHAPUS:** Blok @if ($errors->any()) yang menampilkan notifikasi lama di dalam halaman --}}

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="text-gray-700 font-medium">Email</label>
                        <input type="email" name="email" required
                            class="mt-1 w-full p-3 border rounded-lg focus:ring-gray-800 focus:border-gray-800">
                    </div>

                    <div class="mb-6">
                        <label class="text-gray-700 font-medium">Password</label>
                        <input type="password" name="password" required
                            class="mt-1 w-full p-3 border rounded-lg focus:ring-gray-800 focus:border-gray-800">
                    </div>

                    <button class="w-full bg-gray-900 hover:bg-gray-700 text-white py-3 rounded-lg font-semibold shadow">
                        Login
                    </button>
                </form>

                <p class="text-center text-gray-600 text-sm mt-4">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-gray-900 hover:underline">Register</a>
                </p>
            </div>

            <div class="hidden md:block bg-gray-900">
                <img src="https://i.pinimg.com/736x/11/94/bb/1194bb43d772b51322ca89617fe514cc.jpg"
                    alt="Ilustrasi Login Monokrom" class="w-full h-full object-cover opacity-70">
            </div>

        </div>

    </div>
@endsection
