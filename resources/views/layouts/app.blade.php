<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Wiki-Rick')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        portal: {
                            50:  '#eefff4',
                            100: '#d7ffe6',
                            200: '#b2ffcf',
                            300: '#76ffaa',
                            400: '#33f57d',
                            500: '#09dc59',
                            600: '#00b847',
                            700: '#048f3b',
                            800: '#0a7133',
                            900: '#0a5d2c',
                        },
                        rick: {
                            50:  '#f0f5fe',
                            100: '#dde8fc',
                            200: '#c3d8fa',
                            300: '#9ac0f6',
                            400: '#6a9ff0',
                            500: '#477dea',
                            600: '#3260de',
                            700: '#294dcc',
                            800: '#2740a6',
                            900: '#253a83',
                        },
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 bg-gray-900/80 backdrop-blur-lg border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('characters.index') }}" class="flex items-center gap-3 group">
                    <span class="text-3xl">🛸</span>
                    <span class="text-xl font-extrabold tracking-tight bg-gradient-to-r from-portal-400 to-rick-400 bg-clip-text text-transparent group-hover:from-portal-300 group-hover:to-rick-300 transition-all">
                        Wiki-Rick
                    </span>
                </a>
                <a href="{{ route('characters.index') }}" class="text-sm text-gray-400 hover:text-portal-400 transition-colors">
                    Personajes
                </a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-gray-800 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-sm text-gray-500">
            Wiki-Rick &copy; {{ date('Y') }} &mdash; Datos de <a href="https://rickandmortyapi.com" target="_blank" class="text-portal-500 hover:text-portal-400 underline">rickandmortyapi.com</a>
        </div>
    </footer>

</body>
</html>
