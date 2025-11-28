<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="icon" href="../img/paw-paw.png" type="image/x-icon">

    <!-- bootstrap icon -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- fontawesome icon -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- iconify icon -->
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>{{ $title ?? 'IPAWN' }}</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/tema.css') }}"> --}}
    <!-- Styles / Scripts -->
    {!! ToastMagic::styles() !!}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @livewireStyles
</head>

<body class="bg-[url(../img/bg-kucing.png)] bg-cover bg-bottom bg-no-repeat min-h-screen">
    <main class="min-h-screen flex justify-end items-center p-4">
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
