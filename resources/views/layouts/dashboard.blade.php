<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Jalur Langit</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="https://i.imgur.com/wuuewS5.png" type="image/x-icon" >
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --sidebar-bg: #1e1b4b;
            --sidebar-bg-gradient: linear-gradient(to bottom, #1e1b4b, #312e81);
            --content-bg: #ffffff;
            --accent-color: #a5b4fc;
            --text-light: #e0e7ff;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        
        /* Sidebar Styles */
        .sidebar {
            background-image: var(--sidebar-bg-gradient);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-right: none;
            color: var(--text-light);
            height: 100vh; /* Full height */
            position: fixed; /* Fixed position */
            overflow-y: auto; /* Enable scroll if needed */
            scrollbar-width: thin; /* Firefox */
            scrollbar-color: rgba(255, 255, 255, 0.2) transparent; /* Firefox */
        }

        /* Custom scrollbar for webkit browsers */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
        }
        
        .sidebar-open {
            transform: translateX(0) !important;
        }
        
        .sidebar-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            transition: opacity 0.3s ease, visibility 0.3s ease;
            backdrop-filter: blur(5px);
            z-index: 25;
        }
        
        .nav-item {
            transition: all 0.25s ease;
            color: var(--text-light);
            opacity: 0.85;
            border-radius: 10px;
            margin: 5px 0;
        }
        
        .nav-item:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.12);
            transform: translateX(4px);
            opacity: 1;
        }
        
        .nav-item.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.18);
            font-weight: 500;
            opacity: 1;
            box-shadow: 3px 0 0 0 var(--accent-color) inset;
        }
        
        /* Content Styles */
        .content-wrapper {
            margin-left: 0;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            width: 100%;
        }
        
        @media (min-width: 768px) {
            .content-wrapper {
                margin-left: 18rem; /* 288px (width of sidebar) */
                width: calc(100% - 18rem);
            }
        }
        
        .content-card {
            background: var(--content-bg);
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }
        
        .stat-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            border-color: rgba(99, 102, 241, 0.3);
        }
        
        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        /* Button Styles */
        .btn-primary {
            background: var(--primary-color);
            color: white;
            border-radius: 12px;
            transition: all 0.25s ease;
            box-shadow: 0 2px 10px rgba(99, 102, 241, 0.2);
        }
        
        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(99, 102, 241, 0.35);
        }
        
        .btn-secondary {
            background: #f1f5f9;
            color: #334155;
            border-radius: 12px;
            transition: all 0.25s ease;
        }
        
        .btn-secondary:hover {
            background: #e2e8f0;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
        
        /* Card Styles */
        .amalan-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .amalan-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
            border-color: var(--accent-color);
        }
        
        /* Form Styles */
        .form-input {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            transition: all 0.25s ease;
            padding: 10px 14px;
        }
        
        .form-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            outline: none;
        }
        
        .checkbox-item {
            transition: all 0.25s ease;
        }
        
        .checkbox-item:hover {
            transform: translateX(3px);
        }
        
        /* Pagination Styles */
        .pagination .page-item.active .page-link {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .pagination .page-link {
            color: var(--primary-color);
            border-radius: 10px;
            margin: 0 3px;
        }
        
        /* Logo Styles */
        .logo-icon {
            background: linear-gradient(135deg, #818cf8 0%, #6366f1 100%);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }
        
        /* Mobile Header */
        .mobile-header {
            backdrop-filter: blur(15px);
            background-color: rgba(255, 255, 255, 0.85);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.35s ease-out forwards;
            opacity: 0;
        }
        
        /* Glassmorphism effect for cards */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="antialiased text-gray-700">

<div class="flex relative">
    <!-- Sidebar Overlay (Mobile) -->
    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 opacity-0 invisible md:hidden"></div>
    
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar fixed w-72 p-6 transform -translate-x-full md:translate-x-0 z-30">
        <div class="flex flex-col">
            <!-- Logo Section -->
            <div class="mb-10 pt-2 animate-fade-in" style="animation-delay: 0.1s">
                <div class="flex items-center space-x-4">
                    <div class="logo-icon p-3 rounded-xl text-white">
                        <i class="fas fa-cloud-sun text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Jalur Langit</h1>
                        <p class="text-xs text-indigo-200">Spiritual Journey</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('dashboard.index') }}" class="nav-item flex items-center px-4 py-3.5 rounded-lg text-sm animate-fade-in" style="animation-delay: 0.2s">
                    <i class="fas fa-chart-pie w-5 mr-3 text-center opacity-90"></i>
                    <span>Statistik</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-60"></i>
                </a>
                
                <a href="{{ route('amalan.index') }}" class="nav-item flex items-center px-4 py-3.5 rounded-lg text-sm animate-fade-in" style="animation-delay: 0.25s">
                    <i class="fas fa-book-open w-5 mr-3 text-center opacity-90"></i>
                    <span>Amalan</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-60"></i>
                </a>
                
                <a href="{{ route('kategori.index') }}" class="nav-item flex items-center px-4 py-3.5 rounded-lg text-sm animate-fade-in" style="animation-delay: 0.3s">
                    <i class="fas fa-tags w-5 mr-3 text-center opacity-90"></i>
                    <span>Kategori</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-60"></i>
                </a>
                
                <a href="{{ route('profile.edit') }}" class="nav-item flex items-center px-4 py-3.5 rounded-lg text-sm animate-fade-in" style="animation-delay: 0.35s">
                    <i class="fas fa-user-cog w-5 mr-3 text-center opacity-90"></i>
                    <span>Profil Saya</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-60"></i>
                </a>
            </nav>
            
            <!-- Footer/Settings -->
            <div class="mt-6 pt-6 border-t border-indigo-500/30 animate-fade-in" style="animation-delay: 0.4s">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-item flex items-center px-4 py-3.5 rounded-lg text-sm w-full text-left hover:bg-red-500/10 hover:text-red-200">
                        <i class="fas fa-sign-out-alt w-5 mr-3 text-center opacity-90"></i>
                        <span>Keluar</span>
                        <i class="fas fa-chevron-right ml-auto text-xs opacity-60"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Mobile Header -->
        <header class="md:hidden sticky top-0 z-10 mobile-header border-b border-gray-200/80 px-5 py-4 flex items-center justify-between">
            <button id="menuToggle" class="p-2 rounded-lg text-gray-700 hover:text-indigo-600 hover:bg-gray-100/50 transition-all">
                <i class="fas fa-bars text-lg"></i>
            </button>
            <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
            <div class="w-8"></div> <!-- Balance the header -->
        </header>
        
        <!-- Content Area -->
        <main class="min-h-screen pb-10 bg-gradient-to-br from-gray-50 to-indigo-50/30">
            <div class="p-5 md:p-8">
                @yield('content')
            </div>
        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menuToggle');
        const overlay = document.getElementById('sidebarOverlay');
        
        // Toggle sidebar with animation
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('opacity-0');
            overlay.classList.toggle('invisible');
            overlay.classList.toggle('visible');
            document.body.classList.toggle('overflow-hidden');
        });
        
        // Close sidebar when clicking overlay
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.add('opacity-0', 'invisible');
            overlay.classList.remove('visible');
            document.body.classList.remove('overflow-hidden');
        });
        
        // Highlight active menu item
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-item').forEach(item => {
            const href = item.getAttribute('href');
            if (href && currentPath.includes(href)) {
                item.classList.add('active');
            }
        });
        
        // Close sidebar when clicking outside (mobile)
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 768 && 
                !sidebar.contains(e.target) && 
                !menuToggle.contains(e.target)) {
                sidebar.classList.remove('sidebar-open');
                overlay.classList.add('opacity-0', 'invisible');
                overlay.classList.remove('visible');
                document.body.classList.remove('overflow-hidden');
            }
        });
    });
</script>

</body>
</html>