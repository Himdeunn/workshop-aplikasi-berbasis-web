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
                <a href="{{ route('employees.index') }}" class="text-gray-700 hover:text-blue-600 transition">Pegawai</a>
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
                    <!-- Heroicon: menu -->
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
        <a href="{{ route('employees.index') }}" class="block text-gray-700 hover:text-blue-600 transition">Pegawai</a>
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
