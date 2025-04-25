@extends('layouts.dashboard')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Kategori</h2>
        <a href="{{ route('kategori.create') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-md hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-md flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-50 rounded-lg border border-gray-200">
        @forelse ($kategoris as $kategori)
            <div class="p-4 hover:bg-gray-100 border-b last:border-b-0 flex justify-between items-center transition-colors duration-150">
                <span class="font-medium text-gray-700">{{ $kategori->nama }}</span>
                <div class="flex gap-3">
                    <a href="{{ route('kategori.edit', $kategori->id) }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button 
                            type="button"
                            onclick="confirmDelete(this.parentElement)"
                            class="text-red-500 hover:text-red-700 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-gray-500">
                Belum ada kategori. Silakan tambahkan kategori baru.
            </div>
        @endforelse
    </div>
</div>

<script>
function confirmDelete(form) {
    if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
        form.submit();
    }
}
</script>
@endsection