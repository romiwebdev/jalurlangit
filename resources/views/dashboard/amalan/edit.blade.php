@extends('layouts.dashboard')

@section('title', isset($amalan) ? 'Edit Amalan' : 'Tambah Amalan Baru')
@section('content')
    <div class="animate-fade-in" style="animation-delay: 0.1s">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
                    <i class="fas {{ isset($amalan) ? 'fa-edit' : 'fa-plus-circle' }} text-primary-600 mr-2"></i>
                    {{ isset($amalan) ? 'Edit Amalan' : 'Tambah Amalan Baru' }}
                </h1>
                <p class="text-gray-500 mt-1">
                    {{ isset($amalan) ? 'Perbarui detail amalan' : 'Isi form untuk menambahkan amalan baru' }}
                </p>
            </div>
            <a href="{{ route('amalan.index') }}" class="btn-secondary flex items-center px-4 py-2.5 text-sm">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <form action="{{ isset($amalan) ? route('amalan.update', $amalan->id) : route('amalan.store') }}" method="POST" class="space-y-6">
            @csrf
            @if(isset($amalan))
                @method('PUT')
            @endif

            <!-- Informasi Amalan -->
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">
                    <i class="fas fa-info-circle text-primary-600 mr-2"></i>Informasi Amalan
                </h2>
                
                <div class="space-y-5">
                    <!-- Judul -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Amalan*</label>
                        <input type="text" name="judul" value="{{ old('judul', $amalan->judul ?? '') }}" 
                               class="form-input w-full" placeholder="Sholat Tahajud" required>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi*</label>
                        <textarea name="deskripsi" rows="4" class="form-input w-full" 
                                  placeholder="Deskripsi lengkap tentang amalan ini..." required>{{ old('deskripsi', $amalan->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Link Video -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Link Video (opsional)</label>
                        <input type="url" name="link" value="{{ old('link', $amalan->link ?? '') }}"
                               class="form-input w-full" placeholder="https://example.com/video">
                        @error('link')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Kategori -->
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">
                    <i class="fas fa-tags text-primary-600 mr-2"></i>Kategori
                </h2>
                
                @if($kategoris->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach($kategoris as $kategori)
                            <label class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-primary-300 transition">
                                <input type="checkbox" name="kategoris[]" value="{{ $kategori->id }}"
                                       {{ isset($amalan) && in_array($kategori->id, $amalan->kategoris->pluck('id')->toArray()) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-primary-600 focus:ring-primary-500 h-4 w-4">
                                <span class="ml-3 text-sm font-medium text-gray-700">{{ $kategori->nama }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('kategoris')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                @else
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                            <i class="fas fa-exclamation-circle text-xl text-gray-400"></i>
                        </div>
                        <h4 class="text-sm font-medium text-gray-900 mb-1">Belum ada kategori</h4>
                        <p class="text-xs text-gray-500 mb-3">Buat kategori terlebih dahulu untuk mengatur amalan</p>
                        <a href="{{ route('kategori.create') }}" class="text-sm font-medium text-primary-600 hover:text-primary-800 inline-flex items-center">
                            Buat kategori baru <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col-reverse md:flex-row justify-end gap-3">
                <a href="{{ route('amalan.index') }}" class="btn-secondary px-6 py-3 text-sm">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="btn-primary px-6 py-3 text-sm">
                    <i class="fas fa-save mr-2"></i> {{ isset($amalan) ? 'Update Amalan' : 'Simpan Amalan' }}
                </button>
            </div>
        </form>
    </div>
@endsection