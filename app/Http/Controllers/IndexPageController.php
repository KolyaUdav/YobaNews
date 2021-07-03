<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class IndexPageController extends Controller
{
    public function showNewPosts() {
        $posts = Post::latest()->take(5)->get();

        return view('index')->with('posts', $posts);
    }
}
