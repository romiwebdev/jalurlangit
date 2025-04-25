@extends('layouts.dashboard')

@section('title', 'Statistik')
@section('content')
    <div class="animate-fade-in" style="animation-delay: 0.1s">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Dashboard Statistik</h1>
                <p class="text-gray-500 mt-1">Ringkasan aktivitas dan perkembangan amalan</p>
            </div>
            <div class="hidden md:block">
                <span class="text-sm text-gray-500">Terakhir diperbarui: {{ $lastUpdated->format('d M Y H:i') }}</span>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Statistik Jumlah Amalan -->
            <div class="stat-card p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Amalan</p>
                        <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $jumlahAmalan }}</h3>
                        <p class="text-xs text-gray-500">Amalan yang tersedia</p>
                    </div>
                    <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                        <i class="fas fa-book-open text-lg"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('amalan.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center">
                        Lihat semua <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Statistik Jumlah Kategori -->
            <div class="stat-card p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Kategori</p>
                        <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $jumlahKategori }}</h3>
                        <p class="text-xs text-gray-500">Kategori yang tersedia</p>
                    </div>
                    <div class="p-3 rounded-lg bg-green-50 text-green-600">
                        <i class="fas fa-folder text-lg"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('kategori.index') }}" class="text-sm font-medium text-green-600 hover:text-green-800 flex items-center">
                        Lihat semua <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Statistik Kategori Terpopuler -->
            <div class="stat-card p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Kategori Terpopuler</p>
                        @if($kategoriTerpopuler)
                            <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $kategoriTerpopuler->nama }}</h3>
                            <p class="text-sm text-gray-500">{{ $kategoriTerpopuler->amalans_count }} amalan</p>
                        @else
                            <h3 class="text-2xl font-bold text-gray-900 mb-1">-</h3>
                            <p class="text-sm text-gray-500">Belum ada data</p>
                        @endif
                    </div>
                    <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                        <i class="fas fa-star text-lg"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <span class="text-sm font-medium text-purple-600 flex items-center">
                        <i class="fas fa-chart-line mr-1 text-xs"></i> Tren meningkat
                    </span>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="card p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Aktivitas Terkini</h2>
                <a href="#" class="text-sm font-medium text-primary-600 hover:text-primary-800">Lihat semua</a>
            </div>
            <div class="space-y-4">
                @foreach($aktivitas as $item)
                    <div class="flex items-start p-3 rounded-lg hover:bg-gray-50">
                        <div class="p-2 rounded-lg {{ $item['icon_bg'] }} text-white mr-3">
                            <i class="fas {{ $item['icon'] }} text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ $item['judul'] }}</p>
                            <p class="text-xs text-gray-500">{{ $item['waktu'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
