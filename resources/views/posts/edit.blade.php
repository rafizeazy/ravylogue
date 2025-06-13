@extends('layouts.app')

@section('content')
<div class="bg-navy-deep min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/5 rounded-2xl shadow-lg p-8">
            <h1 class="font-serif text-4xl font-bold text-cream-white mb-2">Edit Tulisan</h1>
            <p class="text-cream-white/70 mb-8">Perbarui catatan Anda dan berikan sentuhan baru.</p>

            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-medium text-cream-white/80 mb-1">Judul</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                        class="block w-full px-4 py-3 bg-navy-deep border border-white/20 rounded-lg focus:ring-muted-gold focus:border-muted-gold text-cream-white" required>
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-cream-white/80 mb-1">Konten</label>
                    <textarea name="content" id="content" rows="10"
                        class="block w-full px-4 py-3 bg-navy-deep border border-white/20 rounded-lg focus:ring-muted-gold focus:border-muted-gold text-cream-white" required>{{ old('content', $post->content) }}</textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-cream-white/80 mb-2">Ganti Gambar Sampul (Opsional)</label>
                    @if($post->image)
                    <div class="mb-4">
                        <p class="text-sm text-cream-white/60 mb-2">Gambar saat ini:</p>
                        <img src="{{ asset('images/' . $post->image) }}" alt="Current Image" class="w-48 rounded-md">
                    </div>
                    @endif
                    <input type="file" name="image" id="image" class="block w-full text-sm text-cream-white/70 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-muted-gold/20 file:text-muted-gold hover:file:bg-muted-gold/30" />
                </div>

                @if($tags->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-cream-white/80 mb-3">Tags</label>
                    <div class="flex flex-wrap gap-3">
                        @php $postTags = $post->tags->pluck('id')->toArray(); @endphp
                        @foreach ($tags as $tag)
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                @if(in_array($tag->id, $postTags)) checked @endif
                            class="h-4 w-4 rounded bg-navy-deep border-white/30 text-muted-gold focus:ring-muted-gold">
                            <span class="text-sm text-cream-white/90">{{ $tag->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="pt-4 text-right">
                    <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-navy-deep bg-muted-gold hover:bg-opacity-80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-navy-deep focus:ring-muted-gold">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection