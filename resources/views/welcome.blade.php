<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Stronger glassmorphism with darker tint */
        .glass {
            backdrop-filter: saturate(180%) blur(30px);
            -webkit-backdrop-filter: saturate(180%) blur(30px);
            background-color: rgba(20, 20, 20, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.07);
            box-shadow:
                0 8px 32px 0 rgba(0, 0, 0, 0.85),
                inset 0 0 10px rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body
    class="bg-gradient-to-tr from-black via-gray-900 to-black text-gray-300 antialiased font-sans min-h-screen flex items-center justify-center px-4">

    <main class="glass max-w-xl w-full p-10 rounded-3xl text-center space-y-8">
        <h1 class="text-5xl font-extrabold tracking-tight text-green-500 drop-shadow-lg">
            Welcome to <span class="text-green-400"> {{ config('app.name', 'Laravel') }} </span>
        </h1>

        <p class="text-lg max-w-md mx-auto leading-relaxed text-gray-400">
            Experience deep dark mode with intense glassmorphism — perfect for elegant macOS style apps.
        </p>

        <div class="flex justify-center space-x-6">
            <a href="{{ route('login') }}"
                class="px-8 py-3 rounded-full bg-green-600 bg-opacity-90 hover:bg-opacity-100 transition font-semibold shadow-lg shadow-green-700/80">
                Log In
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="px-8 py-3 rounded-full border border-green-500 text-green-500 hover:bg-green-500 hover:text-gray-900 transition font-semibold shadow-lg shadow-green-600/70">
                    Register
                </a>
            @endif
        </div>
    </main>

    <footer class="absolute bottom-6 w-full text-center text-gray-600 text-sm select-none">
        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Crafted by Vimantha Dilshan
    </footer>
</body>

</html>
