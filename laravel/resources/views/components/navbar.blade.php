<nav class="bg-white shadow-md border-b border-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left: Brand -->
            <div class="flex items-center">
                <a href="{{ url('/') }}"
                    class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    App Pegawai
                </a>
            </div>

            <!-- Center: Nav Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 transition">Dashboard</a>

                <!-- Dropdown: Pegawai -->
                <div class="relative group">
                    <button class="flex items-center text-gray-700 hover:text-blue-600 transition focus:outline-none">
                        Pegawai
                        <svg class="ml-1 h-4 w-4 transform group-hover:rotate-180 transition-transform"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-200">
                        <a href="{{ route('employees.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-lg">
                            Data Pegawai
                        </a>
                        <a href="{{ route('departments.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Departments
                        </a>
                        <a href="{{ route('positions.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Positions
                        </a>
                        <a href="{{ route('attendances.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-lg">
                            Attendances
                        </a>
                    </div>
                </div>

                <a href="#" class="text-gray-700 hover:text-blue-600 transition">Laporan</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition">Pengaturan</a>
            </div>

            <!-- Right: User / Auth -->
            <div class="hidden md:flex items-center">
                <form method="POST" action="#">
                    @csrf
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition">
                        Logout
                    </button>
                </form>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center md:hidden">
                <button id="mobile-menu-button" class="text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden px-4 pb-4 space-y-2 bg-white border-t border-gray-200">
        <a href="{{ url('/') }}" class="block text-gray-700 hover:text-blue-600 transition">Dashboard</a>

        <!-- Dropdown (Accordion style for mobile) -->
        <div x-data="{ open: false }" class="border-t border-gray-100 pt-2">
            <button @click="open = !open"
                class="flex justify-between items-center w-full text-gray-700 hover:text-blue-600 transition">
                Pegawai
                <svg :class="{ 'rotate-180': open }" class="h-4 w-4 transform transition-transform"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" class="mt-2 pl-4 space-y-1">
                <a href="{{ route('employees.index') }}" class="block text-gray-700 hover:text-blue-600 transition">Data
                    Pegawai</a>
                <a href="{{ route('departments.index') }}"
                    class="block text-gray-700 hover:text-blue-600 transition">Departments</a>
                <a href="{{ route('positions.index') }}"
                    class="block text-gray-700 hover:text-blue-600 transition">Positions</a>
                <a href="{{ route('attendances.index') }}"
                    class="block text-gray-700 hover:text-blue-600 transition">Attendances</a>
            </div>
        </div>

        <a href="#" class="block text-gray-700 hover:text-blue-600 transition">Laporan</a>
        <a href="#" class="block text-gray-700 hover:text-blue-600 transition">Pengaturan</a>

        <form method="POST" action="#">
            @csrf
            <button type="submit"
                class="w-full text-left bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition">
                Logout
            </button>
        </form>
    </div>
</nav>

<!-- Alpine.js for dropdown toggle (lightweight) -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
    // Simple toggle for mobile menu
    document.addEventListener("DOMContentLoaded", function() {
        const btn = document.getElementById("mobile-menu-button");
        const menu = document.getElementById("mobile-menu");
        btn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });
    });
</script>
