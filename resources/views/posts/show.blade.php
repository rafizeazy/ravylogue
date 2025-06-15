@extends('layouts.app')

@section('content')
<div class="bg-navy-deep py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <article>
            @if ($post->image)
            <img class="w-full h-64 md:h-96 object-cover rounded-2xl shadow-2xl mb-8" src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}">
            @endif

            <header class="mb-8 text-center relative">
                <!-- Tombol Edit dan Hapus Postingan -->
                @canany(['update', 'delete'], $post)
                <div x-data="{}" class="absolute top-0 right-0 flex items-center gap-x-2">
                    @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition-colors" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cream-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    @endcan
                    @can('delete', $post)
                    <button @click="$dispatch('open-delete-modal', { deleteUrl: '{{ route('posts.destroy', $post) }}' })" class="p-2 rounded-full bg-rosewood/50 hover:bg-rosewood/80 transition-colors" title="Hapus">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cream-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    @endcan
                </div>
                @endcanany

                <h1 class="font-serif text-4xl md:text-6xl font-extrabold text-cream-white leading-tight mb-4 pt-12">
                    {{ $post->title }}
                </h1>
                <div class="text-sm text-cream-white/60">
                    <span>Diterbitkan pada {{ $post->created_at->format('d F Y') }} oleh </span>
                    <span class="font-semibold text-muted-gold">{{ $post->user->name }}</span>
                    <span class="mx-2">·</span>
                    <span>{{ $post->views }} kali dilihat</span>
                </div>
            </header>

            <div class="prose prose-lg max-w-none text-cream-white/80 prose-headings:text-cream-white prose-a:text-muted-gold prose-strong:text-cream-white leading-relaxed">
                {!! nl2br(e($post->content)) !!}
            </div>

            @if($post->tags->count() > 0)
            <div class="mt-10 pt-6 border-t border-white/10">
                <h3 class="text-lg font-semibold text-cream-white mb-3">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($post->tags as $tag)
                    <span class="bg-muted-gold/10 text-muted-gold text-sm font-medium px-3 py-1 rounded-full">
                        {{ $tag->name }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
        </article>

        <!-- Post Actions: Likes -->
        <div class="mt-8 pt-8 border-t border-white/10 flex items-center justify-between">
            <form action="{{ route('posts.like', $post) }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center space-x-2 text-cream-white/70 hover:text-white transition-colors group">
                    @if($post->isLikedByUser())
                    <!-- Liked State -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rosewood" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-semibold">Disukai</span>
                    @else
                    <!-- Unliked State -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:text-rosewood transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span>Suka</span>
                    @endif
                </button>
            </form>
            <div class="text-sm text-cream-white/60">
                <span>{{ $post->likes->count() }} Suka</span>
            </div>
        </div>

        <!-- Manual Comments Section -->
        <div class="mt-16 border-t border-white/10 pt-12">
            <h2 class="text-3xl font-serif font-bold text-cream-white mb-8">Diskusi ({{ $post->comments->count() }})</h2>
            @auth
            <div class="bg-white/5 rounded-2xl p-6 mb-8">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea name="content" rows="4" class="w-full px-4 py-3 bg-navy-deep border-white/20 rounded-lg focus:ring-muted-gold focus:border-muted-gold text-cream-white placeholder-cream-white/50" placeholder="Bagikan pandangan Anda..." required></textarea>
                    <div class="mt-4 text-right">
                        <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-navy-deep bg-muted-gold hover:bg-opacity-80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-muted-gold">
                            Kirim Komentar
                        </button>
                    </div>
                </form>
            </div>
            @else
            <div class="bg-white/5 rounded-2xl p-6 mb-8 text-center">
                <p class="text-cream-white/70">Silakan <a href="{{ route('login') }}" class="text-muted-gold hover:underline font-semibold">login</a> untuk berpartisipasi dalam diskusi.</p>
            </div>
            @endauth

            <div class="space-y-6">
                @forelse ($post->comments as $comment)
                <div class="bg-white/5 rounded-2xl p-5" x-data="{ editing: false }">
                    <div class="flex items-start space-x-4">
                        <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&color=1E293B&background=B99A6D" alt="{{ $comment->user->name }}">
                        <div class="flex-1">
                            <div x-show="!editing">
                                <div class="flex items-center justify-between">
                                    <p class="font-semibold text-cream-white">{{ $comment->user->name }}</p>
                                    <div class="flex items-center space-x-2">
                                        <p class="text-xs text-cream-white/50">{{ $comment->created_at->diffForHumans() }}</p>
                                        @canany(['update', 'delete'], $comment)
                                        <div class="relative" x-data="{ dropdownOpen: false }">
                                            <button @click="dropdownOpen = !dropdownOpen" class="text-cream-white/50 hover:text-white"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                                </svg></button>
                                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-32 bg-navy-deep rounded-md shadow-lg ring-1 ring-white/10 z-10" style="display:none;">
                                                @can('update', $comment)<a href="#" @click.prevent="editing = true; dropdownOpen = false" class="block px-4 py-2 text-sm text-cream-white/80 hover:bg-white/5">Edit</a>@endcan
                                                @can('delete', $comment)<a href="#" @click.prevent="$dispatch('open-delete-modal', { deleteUrl: '{{ route('comments.destroy', $comment) }}' })" class="block px-4 py-2 text-sm text-rosewood hover:bg-white/5">Hapus</a>@endcan
                                            </div>
                                        </div>
                                        @endcanany
                                    </div>
                                </div>
                                <p class="text-cream-white/80 mt-1">{{ $comment->content }}</p>
                            </div>
                            <div x-show="editing" style="display:none;">
                                <form action="{{ route('comments.update', $comment) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="content" rows="3" class="w-full px-3 py-2 bg-navy-deep border-white/20 rounded-lg focus:ring-muted-gold focus:border-muted-gold text-cream-white" required>{{ $comment->content }}</textarea>
                                    <div class="mt-2 flex items-center space-x-2"><button type="submit" class="text-sm px-3 py-1 bg-muted-gold text-navy-deep rounded-md hover:bg-opacity-80">Simpan</button><button type="button" @click="editing = false" class="text-sm text-cream-white/60">Batal</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white/5 rounded-2xl p-6 text-center">
                    <p class="text-cream-white/60">Belum ada diskusi yang dimulai.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection