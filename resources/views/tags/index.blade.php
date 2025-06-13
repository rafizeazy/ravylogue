@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-6">
    <h1 class="text-2xl font-bold mb-4">Tags</h1>
    <a href="{{ route('tags.create') }}" class="bg-blue-500 text-white px-3 py-1 rounded">New Tag</a>

    <ul class="mt-4">
        @foreach ($tags as $tag)
        <li class="mb-2">
            <a href="{{ route('tags.show', $tag) }}" class="text-blue-500">#{{ $tag->name }}</a>
            <span class="text-sm text-gray-500">({{ $tag->posts_count }} posts)</span>
        </li>
        @endforeach
    </ul>
</div>
@endsection