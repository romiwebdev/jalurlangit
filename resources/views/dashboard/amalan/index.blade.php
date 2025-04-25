@extends('layouts.dashboard')

@section('title', 'Daftar Amalan')
@section('content')
    <div class="animate-fade-in" style="animation-delay: 0.1s">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1">Daftar Amalan</h2>
                <p class="text-gray-500">Kelola semua amalan yang tersedia dalam aplikasi</p>
            </div>
            <div>
                <a href="{{ route('amalan.create') }}" class="btn-primary flex items-center px-5 py-3 text-sm font-medium rounded-xl shadow-md hover:shadow-lg">
                    <i class="fas fa-plus mr-2.5"></i> Tambah Amalan
                </a>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="content-card p-5 mb-8 animate-fade-in" style="animation-delay: 0.2s">
            <form method="GET" action="{{ route('amalan.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari judul amalan..."
                        value="{{ request('search') }}"
                        class="form-input pl-11 w-full bg-gray-50 focus:bg-white text-gray-700"
                    >
                </div>
            </form>
        </div>

        <!-- Compact Amalan List -->
        @if($amalans->count() > 0)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden animate-fade-in" style="animation-delay: 0.3s">
                <div class="divide-y divide-gray-100">
                    @foreach($amalans as $amalan)
                        <div class="p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-book-open text-sm"></i>
                                    </div>
                                    <h3 class="font-medium text-gray-800">{{ $amalan->judul }}</h3>
                                </div>
                                <div class="flex items-center gap-2">
                                    <!-- Detail Button -->
                                    <button onclick="showAmalanDetail({{ json_encode($amalan) }})"
                                       class="w-8 h-8 rounded-full flex items-center justify-center text-emerald-600 hover:bg-emerald-50 transition-colors"
                                       title="Detail">
                                        <i class="fas fa-eye text-sm"></i>
                                    </button>
                                    
                                    <!-- Edit Button -->
                                    <a href="{{ route('amalan.edit', $amalan->id) }}" 
                                       class="w-8 h-8 rounded-full flex items-center justify-center text-blue-600 hover:bg-blue-50 transition-colors"
                                       title="Edit">
                                        <i class="fas fa-pencil-alt text-sm"></i>
                                    </a>
                                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('amalan.destroy', $amalan->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                onclick="confirmDelete(this.parentElement, '{{ $amalan->judul }}')" 
                                                class="w-8 h-8 rounded-full flex items-center justify-center text-red-600 hover:bg-red-50 transition-colors"
                                                title="Hapus">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Integrated Pagination -->
            @if ($amalans->hasPages())
                <div class="mt-6 flex flex-col md:flex-row items-center justify-between animate-fade-in" style="animation-delay: 0.4s">
                    <div class="text-sm text-gray-500 mb-4 md:mb-0">
                        Menampilkan <span class="font-medium">{{ $amalans->firstItem() }}</span> - 
                        <span class="font-medium">{{ $amalans->lastItem() }}</span> dari 
                        <span class="font-medium">{{ $amalans->total() }}</span> amalan
                    </div>
                    
                    <div class="flex items-center gap-1">
                        {{-- Previous Page Link --}}
                        @if ($amalans->onFirstPage())
                            <span class="px-3 py-1 rounded-lg text-gray-300 cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $amalans->previousPageUrl() }}" 
                               class="px-3 py-1 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif

                        {{-- Pagination Elements --}}
                        @php
                            $start = max($amalans->currentPage() - 2, 1);
                            $end = min($start + 4, $amalans->lastPage());
                            if ($end - $start < 4) $start = max($end - 4, 1);
                        @endphp

                        @if($start > 1)
                            <a href="{{ $amalans->url(1) }}" class="px-3 py-1 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">1</a>
                            @if($start > 2)
                                <span class="px-3 py-1 text-gray-400">...</span>
                            @endif
                        @endif

                        @for ($page = $start; $page <= $end; $page++)
                            @if ($page == $amalans->currentPage())
                                <span class="px-3 py-1 rounded-lg bg-emerald-600 text-white font-medium">{{ $page }}</span>
                            @else
                                <a href="{{ $amalans->url($page) }}" 
                                   class="px-3 py-1 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">{{ $page }}</a>
                            @endif
                        @endfor

                        @if($end < $amalans->lastPage())
                            @if($end < $amalans->lastPage() - 1)
                                <span class="px-3 py-1 text-gray-400">...</span>
                            @endif
                            <a href="{{ $amalans->url($amalans->lastPage()) }}" 
                               class="px-3 py-1 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">{{ $amalans->lastPage() }}</a>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($amalans->hasMorePages())
                            <a href="{{ $amalans->nextPageUrl() }}" 
                               class="px-3 py-1 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="px-3 py-1 rounded-lg text-gray-300 cursor-not-allowed">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="content-card p-10 text-center animate-fade-in" style="animation-delay: 0.3s">
                <div class="mx-auto w-24 h-24 rounded-full bg-emerald-50 flex items-center justify-center mb-6">
                    <i class="fas fa-book-open text-3xl text-emerald-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Amalan</h3>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">Anda belum memiliki amalan yang tersimpan. Mulailah dengan menambahkan amalan baru.</p>
                <a href="{{ route('amalan.create') }}" class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-xl shadow-md hover:shadow-lg">
                    <i class="fas fa-plus"></i> Tambah Amalan Pertama
                </a>
            </div>
        @endif
    </div>

    <!-- Amalan Detail Modal -->
    <div id="amalanDetailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 id="modalTitle" class="text-lg leading-6 font-medium text-gray-900 mb-4"></h3>
                            
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Kategori:</h4>
                                <div id="modalCategories" class="flex flex-wrap gap-2 mt-1"></div>
                            </div>
                            
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Deskripsi:</h4>
                                <p id="modalDescription" class="mt-1 text-gray-700 whitespace-pre-line"></p>
                            </div>
                            
                            <div id="modalVideoLink" class="hidden">
                                <h4 class="text-sm font-medium text-gray-500">Video:</h4>
                                <a id="modalVideoUrl" target="_blank" rel="noopener noreferrer" 
                                   class="inline-flex items-center text-emerald-600 hover:text-emerald-800 mt-1">
                                    <i class="fas fa-external-link-alt mr-1"></i>
                                    <span>Tonton Video Amalan</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="hideAmalanDetail()"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmDelete(form, amalanTitle) {
        if (confirm(`Apakah Anda yakin ingin menghapus amalan "${amalanTitle}"?`)) {
            form.submit();
        }
    }
    
    function showAmalanDetail(amalan) {
        // Set modal content
        document.getElementById('modalTitle').textContent = amalan.judul;
        document.getElementById('modalDescription').textContent = amalan.deskripsi;
        
        // Set categories
        const categoriesContainer = document.getElementById('modalCategories');
        categoriesContainer.innerHTML = '';
        if (amalan.kategoris && amalan.kategoris.length > 0) {
            amalan.kategoris.forEach(kategori => {
                const categoryBadge = document.createElement('span');
                categoryBadge.className = 'px-2 py-1 bg-emerald-100 text-emerald-800 text-xs rounded-full';
                categoryBadge.textContent = kategori.nama;
                categoriesContainer.appendChild(categoryBadge);
            });
        } else {
            categoriesContainer.innerHTML = '<span class="text-gray-400">Tidak ada kategori</span>';
        }
        
        // Set video link if available
        const videoContainer = document.getElementById('modalVideoLink');
        const videoUrl = document.getElementById('modalVideoUrl');
        if (amalan.link) {
            videoContainer.classList.remove('hidden');
            videoUrl.href = amalan.link;
        } else {
            videoContainer.classList.add('hidden');
        }
        
        // Show modal
        document.getElementById('amalanDetailModal').classList.remove('hidden');
    }
    
    function hideAmalanDetail() {
        document.getElementById('amalanDetailModal').classList.add('hidden');
    }
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('amalanDetailModal');
        if (event.target === modal) {
            hideAmalanDetail();
        }
    }
    </script>
@endsection