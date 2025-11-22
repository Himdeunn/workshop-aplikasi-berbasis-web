<div x-data="toast()" x-cloak class="fixed top-30 right-13 z-[100] max-w-sm w-full pointer-events-none">
    <div x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-4" @click.away="show = false"
        class="p-4 rounded-xl shadow-2xl border border-gray-300 pointer-events-auto w-full"
        :class="{
            // Sukses: Border Hitam, Background Abu-abu Terang
            'bg-gray-100 border-l-4 border-gray-900': type === 'success',
            // Error: Border Abu-abu Gelap, Background Abu-abu Sedang
            'bg-gray-200 border-l-4 border-gray-700': type === 'error'
        }"
        role="alert">

        <div class="flex items-center">

            {{-- Icon --}}
            <div class="flex-shrink-0 mr-3">
                <svg x-show="type === 'success'" class="w-5 h-5 text-gray-900" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg x-show="type === 'error'" class="w-5 h-5 text-gray-700" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 19V9m0 10a.9.9 0 0 1-1.8 0 .9.9 0 0 1 1.8 0Z" />
                </svg>
            </div>

            {{-- Message --}}
            <div class="text-sm text-gray-800 flex-grow">
                <p x-text="message"></p>
            </div>

            {{-- Close Button --}}
            <button @click="show = false" class="ml-4 p-1 rounded-full text-gray-500 hover:text-gray-900 transition">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    <script>
        // Logika Alpine.js di-render di sini karena ini adalah bagian dari komponen
        function toast() {
            return {
                show: false,
                message: '',
                type: 'success',

                init() {
                    @if (session('success'))
                        this.message = "{{ session('success') }}";
                        this.type = 'success';
                        this.show = true;
                        setTimeout(() => this.show = false, 5000);
                    @endif

                    @if (session('error'))
                        this.message = "{{ session('error') }}";
                        this.type = 'error';
                        this.show = true;
                        setTimeout(() => this.show = false, 7000);
                    @endif
                },

                showToast(message, type = 'success') {
                    this.message = message;
                    this.type = type;
                    this.show = true;
                    setTimeout(() => this.show = false, 5000);
                }
            }
        }
    </script>
</div>
