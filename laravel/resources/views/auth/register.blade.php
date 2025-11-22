@extends('layouts.app')

@section('title', 'The Comp | Register')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-8">

        <div class="w-full max-w-4xl bg-white shadow-lg rounded-xl overflow-hidden md:grid md:grid-cols-2 border border-gray-200">

            <div class="hidden md:block bg-gray-900">
                <img src="https://i.pinimg.com/736x/a0/ed/d2/a0edd2cd8db18fd6d18b71880f570ca1.jpg"
                     alt="Ilustrasi Register Monokrom"
                     class="w-full h-full object-cover opacity-70">
            </div>

            <div class="p-8 lg:p-12 flex flex-col justify-center">

                <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                    Register
                </h2>

                @if ($errors->any())
                    <div class="bg-gray-200 text-gray-800 p-3 rounded mb-4 text-sm border border-gray-400">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="text-gray-700 font-medium">Nama Lengkap</label>
                        <input type="text" name="name" required
                            class="mt-1 w-full p-3 border rounded-lg focus:ring-gray-800 focus:border-gray-800">
                    </div>

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

                    <div class="mb-6">
                        <label class="text-gray-700 font-medium">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="mt-1 w-full p-3 border rounded-lg focus:ring-gray-800 focus:border-gray-800">
                    </div>

                    <button class="w-full bg-gray-900 hover:bg-gray-700 text-white py-3 rounded-lg font-semibold shadow">
                        Register
                    </button>
                </form>

                <p class="text-center text-gray-600 text-sm mt-4">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-gray-900 hover:underline">Login</a>
                </p>
            </div>

        </div>

    </div>
@endsection
