<?php

/**
 * @extends \Illuminate\Routing\Controller
 */

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'search']);
    }

    public function index()
    {
        $posts = Post::with('tags')->latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tags'    => 'nullable|array',
        ]);

        $post = new Post();
        $post->title   = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();

        // Upload gambar ke public/images
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Pastikan folder public/images ada
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0755, true);
            }

            // Pindahkan file ke public/images
            $image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }

        $post->save();

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        // Load relationships
        $post->load('tags', 'comments.user', 'user');

        // Increment view count
        $post->increment('views');

        // Load comment count
        $post->loadCount('comments');

        // Check if the user has liked this post
        $liked = false;
        if (Auth::check()) {
            $liked = $post->likes()->where('user_id', Auth::id())->exists();
        }

        $post->liked = $liked;
        $post->like_count = $post->likes()->count();
        $post->comment_count = $post->comments()->count();
        $post->view_count = $post->views;
        $post->is_owner = Auth::check() && Auth::id() === $post->user_id;

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $tags = Tag::all();
        return view('posts.edit', compact('post', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tags'    => 'nullable|array',
        ]);

        $post->title   = $request->title;
        $post->content = $request->content;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image && file_exists(public_path('images/' . $post->image))) {
                unlink(public_path('images/' . $post->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Pastikan folder public/images ada
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0755, true);
            }

            // Pindahkan file ke public/images
            $image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }

        $post->save();

        $post->tags()->sync($request->tags ?? []);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // Delete image from public/images
        if ($post->image && file_exists(public_path('images/' . $post->image))) {
            unlink(public_path('images/' . $post->image));
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('title', 'like', "%$query%")
            ->orWhere('content', 'like', "%$query%")
            ->with('tags')
            ->latest()
            ->paginate(6);

        return view('posts.index', compact('posts'));
    }

    public function like(Post $post, Request $request)
    {
        $user = $request->user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->detach($user->id);
        } else {
            $post->likes()->attach($user->id);
        }
    }
}
