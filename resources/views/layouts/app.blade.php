<!DOCTYPE html>
<html lang="id" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jalur Langit - Amalan Harian Muslim</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="https://i.imgur.com/wuuewS5.png" type="image/x-icon" >
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f5f0;
        }
        .islamic-pattern {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="%23e2d8c9" fill-opacity="0.3" d="M50 0L0 50L50 100L100 50L50 0Z"/></svg>');
            background-size: 80px 80px;
        }
        .arabic-font {
            font-family: 'Amiri', serif;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Navbar -->
<nav class="fixed w-full top-0 z-50 bg-emerald-800 text-white shadow-lg">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-xl font-bold flex items-center">
            <span class="arabic-font text-2xl mr-2">ﷲ</span>
            <span>Jalur Langit</span>
        </a>
        <div class="space-x-4 text-sm hidden md:flex">
            <a href="{{ route('beranda') }}" class="hover:text-amber-300 transition-colors flex items-center">
                <i class="fas fa-book-open mr-2"></i> Amalan
            </a>
            <a href="{{ route('favorit') }}" class="hover:text-amber-300 transition-colors flex items-center">
                <i class="fas fa-heart mr-2"></i> Favorit
            </a>
        </div>
        <button class="md:hidden text-xl" id="mobile-menu-button">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden hidden bg-emerald-700 px-4 py-2" id="mobile-menu">
        <a href="{{ route('beranda') }}" class="block py-2 hover:text-amber-300 transition-colors">
            <i class="fas fa-book-open mr-2"></i> Amalan
        </a>
        <a href="{{ route('favorit') }}" class="block py-2 hover:text-amber-300 transition-colors">
            <i class="fas fa-heart mr-2"></i> Favorit
        </a>
    </div>
</nav>


    <!-- Content -->
    <main class="flex-1 container mx-auto px-4 pt-24 pb-6">
        @yield('content')
    </main>

<!-- Footer -->
<footer class="bg-emerald-900 text-white py-6 islamic-pattern">
    <div class="container mx-auto px-4 text-center">
        <div class="mb-4">
            <span class="arabic-font text-2xl">ﷲ</span>
        </div>
        <p class="text-sm">&copy; {{ date('Y') }} Jalur Langit. Dibuat dengan <span class="text-amber-300">❤️</span> untuk ummat.</p>
        <p class="text-xs mt-2 opacity-75">
            "Barangsiapa menunjukkan kepada kebaikan maka baginya pahala seperti pahala pelakunya" (HR. Muslim)
        </p>
        <div class="mt-4 text-xs opacity-75">
            <p>Dikembangkan oleh 
                <a href="http://romifullstack.vercel.app" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="text-amber-300 hover:underline transition-colors">
                    Romi Fullstack Developer
                </a>
            </p>
        </div>
    </div>
</footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
    
    @yield('scripts')
</body>
</html>