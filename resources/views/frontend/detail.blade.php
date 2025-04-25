@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header with decorative elements -->
        <div class="bg-emerald-700 text-white px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">{{ $amalan->judul }}</h1>
            <span class="arabic-font text-xl">ﷲ</span>
        </div>
        
        <div class="p-6 space-y-6">
            <!-- Categories -->
            <div class="flex flex-wrap gap-2">
                @foreach($amalan->kategoris as $kategori)
                    <span class="bg-emerald-100 text-emerald-800 text-xs px-3 py-1 rounded-full">{{ $kategori->nama }}</span>
                @endforeach
            </div>
            
            <!-- Content -->
            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($amalan->deskripsi)) !!}
            </div>
            
            <!-- Video link if available -->
            @if($amalan->link)
            <div class="border-t pt-4">
                <a href="{{ $amalan->link }}" target="_blank" 
                   class="inline-flex items-center text-emerald-600 hover:text-emerald-800 transition-colors">
                    <i class="fab fa-youtube mr-2 text-red-500"></i> Tonton Video Amalan
                </a>
            </div>
            @endif
            
            <!-- Action buttons -->
            <div class="flex flex-wrap gap-3 pt-4 border-t">
                <button onclick="copyAmalan()" 
                        class="flex items-center bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg transition-colors">
                    <i class="far fa-copy mr-2"></i> Salin
                </button>
                <button onclick="shareAmalan()" 
                        class="flex items-center bg-emerald-100 hover:bg-emerald-200 text-emerald-800 px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-share-alt mr-2"></i> Bagikan
                </button>
                <button onclick="toggleFavorite({{ $amalan->id }})" 
                        class="flex items-center bg-amber-100 hover:bg-amber-200 text-amber-800 px-4 py-2 rounded-lg transition-colors"
                        id="fav-btn-{{ $amalan->id }}">
                    <i class="far fa-heart mr-2"></i> Favorit
                </button>
            </div>
        </div>
    </div>

    <!-- Simple Back Button Below the Card -->
<div class="mt-6">
    <a href="{{ route('beranda') }}" 
       class="inline-flex items-center text-emerald-600 hover:text-emerald-800 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Amalan
    </a>
</div>
</div>
@endsection

@section('scripts')
<script>
    function copyAmalan() {
        const text = `{{ $amalan->judul }}\n\n{{ strip_tags($amalan->deskripsi) }}`;
        navigator.clipboard.writeText(text).then(() => {
            // Show toast notification
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-4 right-4 bg-emerald-600 text-white px-4 py-2 rounded-lg shadow-lg';
            toast.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Amalan berhasil disalin!';
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
        });
    }

    function shareAmalan() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $amalan->judul }}',
                text: 'Amalan dari Jalur Langit',
                url: '{{ url()->current() }}'
            }).catch(err => {
                console.log('Error sharing:', err);
            });
        } else {
            // Fallback for browsers that don't support Web Share API
            const shareText = `Amalan dari Jalur Langit: {{ $amalan->judul }}\n\nBaca selengkapnya di: {{ url()->current() }}`;
            window.open(`https://wa.me/?text=${encodeURIComponent(shareText)}`, '_blank');
        }
    }

    function toggleFavorite(id) {
        let favs = JSON.parse(localStorage.getItem('favorites') || '[]');
        const btn = document.getElementById('fav-btn-' + id);
        
        if (favs.includes(id)) {
            favs = favs.filter(favId => favId !== id);
            btn.innerHTML = '<i class="far fa-heart mr-2"></i> Favorit';
            btn.classList.remove('bg-amber-200', 'text-amber-800');
            btn.classList.add('bg-amber-100', 'text-amber-800');
        } else {
            favs.push(id);
            btn.innerHTML = '<i class="fas fa-heart mr-2 text-amber-500"></i> Favorit';
            btn.classList.remove('bg-amber-100', 'text-amber-800');
            btn.classList.add('bg-amber-200', 'text-amber-800');
        }
        
        localStorage.setItem('favorites', JSON.stringify(favs));
    }

    // Update favorite button state on load
    document.addEventListener('DOMContentLoaded', function() {
        const id = {{ $amalan->id }};
        const favs = JSON.parse(localStorage.getItem('favorites') || '[]');
        const btn = document.getElementById('fav-btn-' + id);
        
        if (favs.includes(id)) {
            btn.innerHTML = '<i class="fas fa-heart mr-2 text-amber-500"></i> Favorit';
            btn.classList.remove('bg-amber-100', 'text-amber-800');
            btn.classList.add('bg-amber-200', 'text-amber-800');
        }
    });
</script>
@endsection