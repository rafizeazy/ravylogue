@extends('layouts.app')

@section('content')
<div class="bg-navy-deep min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/5 rounded-2xl shadow-lg p-8">
            <h1 class="font-serif text-4xl font-bold text-cream-white mb-2">Tuangkan Pikiranmu</h1>
            <p class="text-cream-white/70 mb-8">Buat sebuah catatan baru untuk dibagikan ke seluruh dunia.</p>

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-cream-white/80 mb-1">Judul</label>
                    <input type="text" name="title" id="title" placeholder="Judul tulisan Anda"
                        class="block w-full px-4 py-3 bg-navy-deep border border-white/20 rounded-lg focus:ring-muted-gold focus:border-muted-gold text-cream-white placeholder-cream-white/50" required>
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-cream-white/80 mb-1">Konten</label>
                    <textarea name="content" id="content" rows="10" placeholder="Mulai menulis di sini..."
                        class="block w-full px-4 py-3 bg-navy-deep border border-white/20 rounded-lg focus:ring-muted-gold focus:border-muted-gold text-cream-white placeholder-cream-white/50" required></textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-cream-white/80 mb-2">Gambar Sampul (Opsional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-white/20 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-cream-white/50" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <div class="flex text-sm text-cream-white/60">
                                <div class="w-full flex justify-center">
                                    <label for="image-upload" class="relative cursor-pointer bg-navy-deep rounded-md font-medium text-muted-gold hover:text-muted-gold/80 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-navy-deep focus-within:ring-muted-gold">
                                        <span>Unggah file</span>
                                        <input id="image-upload" name="image" type="file" class="sr-only">
                                    </label>
                                </div>

                            </div>
                            <p class="text-xs text-cream-white/50">PNG, JPG, JPEG hingga 2MB</p>
                        </div>
                    </div>
                </div>

                @if($tags->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-cream-white/80 mb-3">Tags (Opsional)</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($tags as $tag)
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                class="h-4 w-4 rounded bg-navy-deep border-white/30 text-muted-gold focus:ring-muted-gold">
                            <span class="text-sm text-cream-white/90">{{ $tag->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="pt-4 text-right">
                    <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-navy-deep bg-muted-gold hover:bg-opacity-80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-navy-deep focus:ring-muted-gold">
                        Publikasikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection