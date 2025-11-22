@include('components.header')
@include('components.navbar')

<body class="bg-gray-100">
    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    @include('components.ui.toast-notification')
</body>

@include ('components.footer')
