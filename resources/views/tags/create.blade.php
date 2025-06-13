@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-6">
    <h1 class="text-xl font-bold mb-4">{{ isset($tag) ? 'Edit' : 'Create' }} Tag</h1>

    <form action="{{ isset($tag) ? route('tags.update', $tag) : route('tags.store') }}" method="POST">
        @csrf
        @if(isset($tag))
        @method('PUT')
        @endif

        <input type="text" name="name" class="border p-2 w-full mb-2"
            value="{{ old('name', $tag->name ?? '') }}" placeholder="Tag Name" required>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2">
            {{ isset($tag) ? 'Update' : 'Create' }}
        </button>
    </form>
</div>
@endsection