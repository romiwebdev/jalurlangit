@forelse ($amalans as $amalan)
    <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
        <div class="p-5">
            <div class="flex justify-between items-start">
                <h2 class="text-xl font-bold text-emerald-800 mb-2">{{ $amalan->judul }}</h2>
                <button onclick="toggleFavorite({{ $amalan->id }})" 
                        class="text-gray-400 hover:text-amber-500 transition-colors text-lg"
                        id="fav-btn-{{ $amalan->id }}">
                    
                </button>
            </div>
            
            <div class="flex flex-wrap gap-2 mb-3">
                @foreach($amalan->kategoris as $kategori)
                    <span class="bg-emerald-100 text-emerald-800 text-xs px-3 py-1 rounded-full flex items-center">
                        <i class="fas fa-tag mr-1 text-xs opacity-70"></i>
                        {{ $kategori->nama }}
                    </span>
                @endforeach
            </div>
            
            <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                {{ Str::limit($amalan->deskripsi, 120) }}
            </p>
            
            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                <a href="{{ route('amalan.detail', $amalan->id) }}" 
                   class="text-emerald-600 hover:text-emerald-800 transition-colors flex items-center text-sm">
                    Baca Selengkapnya
                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
                
                <span class="text-xs text-gray-400">
                    <i class="far fa-clock mr-1"></i>
                    {{ $amalan->created_at->diffForHumans() }}
                </span>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full bg-white rounded-xl shadow-sm p-8 text-center">
        <div class="text-5xl text-gray-200 mb-4">
            <i class="fas fa-book-open"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-600 mb-2">Tidak ada amalan ditemukan</h3>
        <p class="text-sm text-gray-500 mb-4">Coba gunakan kata kunci lain atau filter yang berbeda</p>
        <a href="{{ route('frontend.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors text-sm">
            <i class="fas fa-sync-alt mr-2"></i>
            Reset Pencarian
        </a>
    </div>
@endforelse