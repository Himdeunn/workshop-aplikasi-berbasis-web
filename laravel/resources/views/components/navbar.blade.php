<nav class="sticky top-0 z-50 p-6" x-data="{ open: false }">
    <div class="bg-white shadow-md border border-gray-400/50 container mx-auto rounded-4xl px-5 py-2 sm:px-8 lg:px-12">
        <div class="flex justify-between h-16">

            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-900">
                    App Pegawai
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">

                @auth
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900 transition">Dashboard</a>

                    @if (auth()->user()->role === 'admin')
                        {{-- ... Menu Admin Desktop (Tidak Berubah) ... --}}
                        <div class="relative group">
                            <button
                                class="flex items-center text-gray-700 hover:text-gray-900 transition focus:outline-none">
                                Pegawai
                                <svg class="ml-1 h-4 w-4 transform group-hover:rotate-180 transition-transform"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div
                                class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-200 z-50">
                                <a href="{{ route('employees.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-900 hover:bg-gray-100">Data Pegawai</a>
                                <a href="{{ route('departments.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-900 hover:bg-gray-100">Departments</a>
                                <a href="{{ route('positions.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-900 hover:bg-gray-100">Positions</a>
                                <a href="{{ route('attendances.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-900 hover:bg-gray-100">Attendances</a>
                            </div>
                        </div>
                        <a href="{{ route('report.index') }}" class="text-gray-700 hover:text-gray-900 transition">Report</a>
                    @endif

                    @if (auth()->user()->role === 'employee')
                        <a href="{{ route('attendance.absence') }}" class="font-semibold text-gray-900 hover:text-gray-700">
                            Absence
                        </a>
                        {{-- TAMBAHAN BARU: Link Settings Employee Desktop --}}
                        <a href="{{ route('settings.index') }}" class="text-gray-700 hover:text-gray-900 transition">
                            Settings
                        </a>
                    @endif

                @endauth
            </div>

            {{-- ... Right Side & Mobile Button (Tidak Berubah) ... --}}
            <div class="hidden md:flex items-center">
                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 rounded-lg text-gray-900 font-semibold hover:bg-gray-100 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="ml-3 px-4 py-2 rounded-lg bg-gray-900 text-white font-semibold hover:bg-gray-700 transition">
                        Register
                    </a>
                @endguest

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-gray-900 text-white px-4.5 py-2.5 rounded-2xl shadow hover:opacity-90 transition">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>

            <div class="flex items-center md:hidden">
                <button @click="open = !open" type="button"
                    class="text-gray-900 hover:text-gray-700 focus:outline-none p-2 -mr-2 rounded-md">
                    <svg x-show="!open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg x-show="open" x-cloak class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="open" x-cloak x-collapse class="md:hidden">
            <div class="pt-2 pb-3 space-y-1 border-t border-gray-200">

                @auth
                    <a href="{{ url('/') }}"
                        class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">
                        Dashboard
                    </a>

                    @if (auth()->user()->role === 'admin')
                        <div x-data="{ dropdownOpen: false }" class="space-y-1">
                            <button @click="dropdownOpen = !dropdownOpen"
                                class="flex justify-between w-full px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">
                                <span>Pegawai</span>
                                <svg :class="{ 'rotate-180': dropdownOpen }" class="ml-1 h-5 w-5 transition-transform"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="dropdownOpen" x-collapse>
                                <a href="{{ route('employees.index') }}"
                                    class="block pl-8 pr-4 py-2 text-sm text-gray-900 hover:bg-gray-100">Data Pegawai</a>
                                <a href="{{ route('departments.index') }}"
                                    class="block pl-8 pr-4 py-2 text-sm text-gray-900 hover:bg-gray-100">Departments</a>
                                <a href="{{ route('positions.index') }}"
                                    class="block pl-8 pr-4 py-2 text-sm text-gray-900 hover:bg-gray-100">Positions</a>
                                <a href="{{ route('attendances.index') }}"
                                    class="block pl-8 pr-4 py-2 text-sm text-gray-900 hover:bg-gray-100">Attendances</a>
                            </div>
                        </div>
                        <a href="{{ route('report.index') }}"
                            class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">
                            Report
                        </a>
                    @endif

                    @if (auth()->user()->role === 'employee')
                        <a href="{{ route('attendance.absence') }}"
                            class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">
                            Absence
                        </a>
                        {{-- TAMBAHAN BARU: Link Settings Employee Mobile --}}
                        <a href="{{ route('settings.index') }}"
                            class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">
                            Settings
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="pt-4">
                        @csrf
                        <button type="submit"
                            class="w-full bg-gray-900 text-white px-4 py-2 rounded-lg shadow font-semibold hover:bg-gray-700 transition">
                            Logout
                        </button>
                    </form>
                @endauth

                @guest
                    <div class="flex flex-col space-y-2 pt-4">
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-lg text-gray-900 font-semibold text-center hover:bg-gray-100 transition border border-gray-900">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 rounded-lg bg-gray-900 text-white font-semibold text-center hover:bg-gray-700 transition">
                            Register
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
