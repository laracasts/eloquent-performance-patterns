<?php

namespace App\Http\Controllers;

use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $years = Post::query()
            ->select('id', 'title', 'slug', 'published_at', 'author_id')
            ->with('author:id,name')
            ->latest('published_at')
            ->get()
            ->groupBy(fn ($post) => $post->published_at->year);

        return view('posts', ['years' => $years]);
    }
}
