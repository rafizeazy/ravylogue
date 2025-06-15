<?php

namespace App\Http\Controllers;


use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    /**
     * Menerapkan middleware auth untuk memastikan hanya user yang login bisa like.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menangani aksi like/unlike pada sebuah post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post)
    {
        // Menggunakan toggle untuk menambahkan like jika belum ada,
        // atau menghapus like jika sudah ada.
        $post->likes()->toggle(Auth::id());

        return back();
    }
}
