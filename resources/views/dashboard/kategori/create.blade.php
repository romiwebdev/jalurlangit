@extends('layouts.dashboard')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('kategori.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Tambah Kategori</h2>
    </div>

    <form action="{{ route('kategori.store') }}" method="POST" class="space-y-5">
        @csrf
        <div class="space-y-2">
            <label for="nama" class="block font-medium text-gray-700">Nama Kategori</label>
            <input 
                type="text" 
                id="nama" 
                name="nama" 
                required 
                class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                placeholder="Masukkan nama kategori">
            @error('nama')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-green-600 text-white px-5 py-2.5 rounded-md hover:bg-green-700 transition-colors duration-200 font-medium flex-grow md:flex-grow-0">
                Simpan
            </button>
            <a href="{{ route('kategori.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-100 transition-colors duration-200 text-center flex-grow md:flex-grow-0">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection