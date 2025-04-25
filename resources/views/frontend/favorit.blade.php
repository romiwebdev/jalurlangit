@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-green-800 mb-2">Amalan Favorit</h1>
        <p class="text-gray-600">Berikut adalah daftar amalan yang Anda tandai sebagai favorit</p>
    </div>

    <div id="amalan-container">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse ($amalans as $amalan)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <h2 class="text-xl font-bold text-green-800 mb-2">{{ $amalan->judul }}</h2>
                            <button onclick="toggleFavorite({{ $amalan->id }})" 
                                    class="text-red-500 transition duration-300 text-xl"
                                    id="fav-btn-{{ $amalan->id }}">
                                <i class="fas fa-heart"></i>
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
                    <i class="fas fa-heart-broken text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Belum ada amalan favorit.</p>
                </div>
            @endforelse
        </div>

        @if($amalans->hasPages())
        <div class="flex justify-center mt-8">
            {{ $amalans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const favs = JSON.parse(localStorage.getItem('favorites') || '[]');
        const url = new URL(window.location.href);

        // Jika belum ada param 'ids' di URL, redirect dengan param
        if (!url.searchParams.has('ids') && favs.length > 0) {
            url.searchParams.set('ids', JSON.stringify(favs));
            window.location.href = url.toString(); // Redirect dengan param
        }

        // Ubah tampilan icon love saat sudah favorit
        favs.forEach(id => {
            const btn = document.getElementById('fav-btn-' + id);
            if (btn) {
                btn.innerHTML = '<i class="fas fa-heart"></i>';
                btn.classList.add('text-red-500');
            }
        });
    });
</script>

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
        location.reload(); // reload supaya daftar favorit diperbarui
    }

    document.addEventListener('DOMContentLoaded', function () {
        const favs = JSON.parse(localStorage.getItem('favorites') || '[]');
        if (favs.length === 0) return;

        const url = new URL(window.location.href);
        url.searchParams.set('ids', JSON.stringify(favs));

        fetch(url.toString())
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.getElementById('amalan-container');
                document.getElementById('amalan-container').innerHTML = newContent.innerHTML;
            });
    });
</script>
@endsection
