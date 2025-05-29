@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-[60vh]">
        <div class="relative w-full h-32 flex items-center justify-center overflow-hidden">
            <div id="welcome-marquee"
                class="absolute whitespace-nowrap text-4xl font-extrabold text-blue-700 animate-marquee">
                <span class="mx-8">Bienvenid@</span>
                <span class="mx-8">Welcome</span>
                <span class="mx-8">Willkommen</span>
                <span class="mx-8">Bienvenue</span>
                <span class="mx-8">Benvenuto</span>
                <span class="mx-8">ようこそ</span>
                <span class="mx-8">欢迎</span>
                <span class="mx-8">Добро пожаловать</span>
                <span class="mx-8">Bem-vindo</span>
                <span class="mx-8">환영합니다</span>
                <span class="mx-8">مرحبا</span>
            </div>
        </div>
        <div class="mt-10 text-center">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">¡{{ Auth::user()->name ?? 'Usuario' }}, estás en el
                sistema de ventas!</h2>
            <p class="text-gray-600">Utiliza el menú lateral para navegar por las diferentes secciones.</p>
        </div>
    </div>

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
            animation: marquee 20s linear infinite;
            will-change: left;
        }
    </style>
@endsection
