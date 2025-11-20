<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap icon -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- fontawesome icon -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>{{ $title ?? 'Page Title' }}</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/tema.css') }}"> --}}
    <!-- Styles / Scripts -->
    {!! ToastMagic::styles() !!}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @livewireStyles
</head>

<body data-theme="default" class="bg-gray-200">
    <main class="min-h-screen flex justify-center items-center p-4">
        {{ $slot }}
    </main>
    @livewireScripts
    {!! ToastMagic::scripts() !!}
    @if (session('toastMagic'))
        <script>
            window.toastFlash = @json(session('toastMagic'));
        </script>
    @endif
    <script>
        Livewire.on('login-success', ({
            token
        }) => {
            localStorage.setItem('guru_token', token);
        });
    </script>
</body>

</html>
