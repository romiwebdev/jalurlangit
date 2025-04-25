@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-green-800 mb-2">Amalan Harian Muslim</h1>
            <p class="text-gray-600">Temukan amalan-amalan sunnah untuk mengisi hari-hari Anda dengan kebaikan</p>
        </div>

        <form method="GET" action="{{ route('beranda') }}" class="mb-4 md:mb-6" id="searchForm">
    <!-- Mobile Version -->
    <div class="flex items-stretch gap-1 md:hidden">
        <div class="relative flex-1 min-w-[120px]">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400 text-sm"></i>
            </div>
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Cari..."
                autocomplete="off"
                class="w-full pl-9 pr-2 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-green-500 text-xs"
                id="mobileSearch"
            />
        </div>

        <select 
            name="kategori"
            class="border border-gray-300 rounded-lg px-2 py-2 focus:ring-1 focus:ring-green-500 text-xs w-[120px]"
            id="mobileCategory"
        >
            <option value="">Semua</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                    {{ Str::limit($kategori->nama, 12) }}
                </option>
            @endforeach
        </select>

        <button 
            type="submit"
            class="bg-green-600 text-white px-3 py-2 rounded-lg text-xs whitespace-nowrap"
            id="mobileSubmit"
        >
            <i class="fas fa-search"></i>
        </button>
    </div>

    <!-- Desktop Version -->
    <div class="hidden md:flex items-center gap-3 max-w-2xl mx-auto">
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Cari amalan..."
                class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 text-base"
            />
        </div>

        <select 
            name="kategori"
            class="border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-green-500 text-base w-48"
        >
            <option value="">Semua Kategori</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama }}
                </option>
            @endforeach
        </select>

        <button 
            type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg transition duration-300 flex items-center"
        >
            <i class="fas fa-search mr-2"></i>
            Cari
        </button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Untuk mobile device
    if (window.innerWidth < 768) {
        const searchForm = document.getElementById('searchForm');
        const mobileSearch = document.getElementById('mobileSearch');
        const mobileCategory = document.getElementById('mobileCategory');
        
        // Cegah form submit default
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            applyFilters();
        });
        
        // Tambahkan event listener untuk select box (opsional)
        mobileCategory.addEventListener('change', function() {
            applyFilters();
        });
        
        function applyFilters() {
            const searchValue = mobileSearch.value;
            const categoryValue = mobileCategory.value;
            
            // Bangun URL dengan parameter
            let url = new URL(window.location.href);
            let params = new URLSearchParams(url.search);
            
            if (searchValue) {
                params.set('search', searchValue);
            } else {
                params.delete('search');
            }
            
            if (categoryValue) {
                params.set('kategori', categoryValue);
            } else {
                params.delete('kategori');
            }
            
            // Update URL tanpa refresh halaman
            window.history.pushState({}, '', `${url.pathname}?${params.toString()}`);
            
            // Lakukan request AJAX atau reload dengan parameter baru
            window.location.search = params.toString();
        }
    }
});
</script>



        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse ($amalans as $amalan)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <h2 class="text-xl font-bold text-green-800 mb-2">{{ $amalan->judul }}</h2>
                            <button onclick="toggleFavorite({{ $amalan->id }})" 
                                    class="text-gray-400 hover:text-red-500 transition duration-300 text-xl"
                                    id="fav-btn-{{ $amalan->id }}">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($amalan->kategoris as $kategori)
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">{{ $kategori->nama }}</span>
                            @endforeach
                        </div>
                        <p class="text-gray-600 mb-4">{{ Str::limit($amalan->deskripsi, 120) }}</p>
                        <a href="{{ route('amalan.detail', $amalan->id) }}" 
                           class="inline-flex items-center text-green-600 hover:text-green-800 transition duration-300">
                            Baca selengkapnya <i class="fas fa-arrow-left ml-2"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8">
                    <i class="fas fa-book-open text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Tidak ada amalan ditemukan.</p>
                </div>
            @endforelse
        </div>

        <!-- Manual Pagination -->
        @if($amalans->hasPages())
        <div class="flex justify-center mt-8">
            <div class="flex items-center space-x-2">
                @if($amalans->onFirstPage())
                    <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                @else
                    <a href="{{ $amalans->previousPageUrl() }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                @endif

                @foreach(range(1, $amalans->lastPage()) as $page)
                    @if($page == $amalans->currentPage())
                        <span class="px-4 py-2 bg-green-800 text-white rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $amalans->url($page) }}" class="px-4 py-2 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition duration-300">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if($amalans->hasMorePages())
                    <a href="{{ $amalans->nextPageUrl() }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                @else
                    <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                @endif
            </div>
        </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    function toggleFavorite(id) {
        let favs = JSON.parse(localStorage.getItem('favorites') || '[]');
        const btn = document.getElementById('fav-btn-' + id);
        
        if (favs.includes(id)) {
            favs = favs.filter(favId => favId !== id);
            btn.innerHTML = '<i class="far fa-heart"></i>';
            btn.classList.remove('text-red-500');
            btn.classList.add('text-gray-400');
        } else {
            favs.push(id);
            btn.innerHTML = '<i class="fas fa-heart"></i>';
            btn.classList.remove('text-gray-400');
            btn.classList.add('text-red-500');
        }
        localStorage.setItem('favorites', JSON.stringify(favs));
    }

    function updateButtons() {
        let favs = JSON.parse(localStorage.getItem('favorites') || '[]');
        favs.forEach(id => {
            let btn = document.getElementById('fav-btn-' + id);
            if (btn) {
                btn.innerHTML = '<i class="fas fa-heart"></i>';
                btn.classList.remove('text-gray-400');
                btn.classList.add('text-red-500');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', updateButtons);
</script>
@endsection