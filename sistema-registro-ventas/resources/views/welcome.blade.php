<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ventas Cheveres</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        @keyframes marquee {
            0% {
                left: 100%;
            }

            100% {
                left: -100%;
            }
        }

        .animate-marquee {
            position: absolute;
            left: 100%;
            animation: marquee 18s linear infinite;
            will-change: left;
            white-space: nowrap;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center font-sans">
    {{-- <header class="w-full max-w-4xl px-4 py-6 flex justify-between items-center">
        <span class="text-2xl font-bold text-blue-700">Ventas Cheveres</span>
        <nav>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2">Iniciar
                        sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white font-medium rounded-lg text-sm px-5 py-2.5">Registrarse</a>
                    @endif
                @endauth
            @endif
        </nav>
    </header> --}}

    <main class="flex flex-col items-center justify-center flex-1 w-full px-4">
        <div class="relative w-full max-w-xl h-20 flex items-center justify-center overflow-hidden mb-8">
            <div id="welcome-marquee" class="animate-marquee text-3xl sm:text-4xl font-extrabold text-blue-700">
                <span class="mx-8">¡Bienvenido!</span>
                <span class="mx-8">Welcome!</span>
                <span class="mx-8">Willkommen!</span>
                <span class="mx-8">Bienvenue!</span>
                <span class="mx-8">Benvenuto!</span>
                <span class="mx-8">ようこそ</span>
                <span class="mx-8">欢迎</span>
                <span class="mx-8">Добро пожаловать!</span>
                <span class="mx-8">Bem-vindo!</span>
                <span class="mx-8">환영합니다!</span>
                <span class="mx-8">مرحبا!</span>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-xl w-full text-center">
            <h1 class="mb-4 text-3xl font-bold text-gray-800">Ventas Cheveres</h1>
            <p class="mb-6 text-gray-600 text-lg">La mejor plataforma para gestionar tus ventas de manera fácil, rápida
                y segura.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('login') }}"
                    class="w-full sm:w-auto text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">Iniciar
                    sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="w-full sm:w-auto text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white font-medium rounded-lg text-sm px-5 py-2.5">Registrarse</a>
                @endif
            </div>
        </div>
        <div class="mt-10 text-gray-500 text-sm">
            &copy; {{ date('Y') }} Ventas Cheveres. Todos los derechos reservados.
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
