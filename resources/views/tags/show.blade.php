@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-6">
    <h1 class="text-2xl font-bold mb-4">#{{ $tag->name }}</h1>

    @foreach ($posts as $post)
    <div class="bg-white p-4 rounded shadow mb-4">
        <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
        <p class="text-gray-600">{{ Str::limit($post->content, 100) }}</p>
        <a href="{{ route('posts.show', $post) }}" class="text-blue-500">Read More</a>
    </div>
    @endforeach

    {{ $posts->links() }}
</div>
@endsection