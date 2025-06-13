{{-- This content should be in resources/views/posts/index.blade.php --}}
@extends('layouts.app')

@section('content')

<!-- Social Links -->
<div class="hidden lg:flex flex-col items-center space-y-4 fixed left-0 top-1/2 transform -translate-y-1/2 ml-4 md:ml-6 z-50">
    <!-- GitHub -->
    <a href="https://github.com/rafizeazy" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gray-200 hover:bg-gray-800 rounded-full flex items-center justify-center text-gray-600 hover:text-white transition-all duration-300 hover:scale-110" title="GitHub">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.91 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
        </svg>
    </a>
    <!-- LinkedIn -->
    <a href="https://www.linkedin.com/in/rafizerzy/" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-blue-100 hover:bg-blue-600 rounded-full flex items-center justify-center text-blue-500 hover:text-white transition-all duration-300 hover:scale-110" title="LinkedIn">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.59-11.018-3.714v-2.155z" />
        </svg>
    </a>
    <!-- Gmail -->
    <a href="mailto:rafiimanullah@gmail.com" class="w-10 h-10 bg-red-100 hover:bg-red-600 rounded-full flex items-center justify-center text-red-500 hover:text-white transition-all duration-300 hover:scale-110" title="Email">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
    </a>
</div>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                Ravylogue
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                Personal Blog untuk berbagi catatan, pengalaman, dan pengetahuan.
            </p>
        </div>

        <!-- Search Bar -->
        <div class="mb-8 max-w-lg mx-auto">
            <form method="GET" action="{{ route('posts.search') }}" class="relative">
                <input type="text" name="query" placeholder="Cari notes..."
                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-full leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ request('query') }}">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
            </form>
        </div>

        <!-- Posts Grid -->
        <div class="grid gap-8 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
            @forelse ($posts as $post)
            <div class="flex flex-col rounded-2xl shadow-lg overflow-hidden bg-white transform hover:-translate-y-1 transition-all duration-300">
                <div class="flex-shrink-0">
                    @if ($post->image)
                    <a href="{{ route('posts.show', $post) }}">
                        <img class="h-48 w-full object-cover" src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}">
                    </a>
                    @else
                    <div class="h-48 w-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">Gambar tidak tersedia</span>
                    </div>
                    @endif
                </div>
                <div class="flex-1 p-6 flex flex-col justify-between">
                    <div class="flex-1">
                        <!-- Tags -->
                        @if($post->tags->isNotEmpty())
                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach($post->tags->take(2) as $tag)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $tag->name }}
                            </span>
                            @endforeach
                        </div>
                        @endif

                        <h3 class="text-xl font-semibold text-gray-900 mt-2">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 transition-colors">
                                {{ $post->title }}
                            </a>
                        </h3>
                    </div>

                    <!-- Read More and Author Info -->
                    <div>
                        <a href="{{ route('posts.show', $post) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                            Read More &rarr;
                        </a>
                        <div class="mt-4 flex items-center">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $post->user->name }}">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $post->user->name }}
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <time datetime="{{ $post->created_at->toIso8601String() }}">{{ $post->created_at->format('d M Y') }}</time>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="lg:col-span-3 md:col-span-2 text-center py-12">
                <h2 class="text-2xl font-semibold text-gray-700">Tidak ada postingan ditemukan</h2>
                <p class="mt-2 text-gray-500">Coba gunakan kata kunci pencarian yang berbeda atau kembali lagi nanti.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection