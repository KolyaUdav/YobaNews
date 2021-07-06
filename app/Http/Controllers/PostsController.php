<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10); // Ограничение в 10 постов на страницу
        return view('posts.list')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateForm($request); // Валидация данных

        // Создание поста 
        $newPost = new Post;
        $newPost->title = $request->input('title');
        $newPost->body = $request->input('body');
        $newPost->image = 'NoImage';
        $newPost->save();

        return redirect('/posts')->with('success', 'Создана новая запись'); // Редирект к списку новостей
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Редактирование поста 
        $editPost = Post::find($id);
        $editPost->title = $request->input('title');
        $editPost->body = $request->input('body');
        // $newPost->image = 'NoImage';
        $editPost->save();

        return redirect('/posts')->with('success', 'Запись отредактирована'); // Редирект к списку новостей
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletePost = Post::find($id);
        $deletePost->delete();

        return redirect('/posts')->with('success', 'Запись удалена');
    }

    private function validateForm($request) {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'max:1999|mimes:jpg, png'
        ]);
    }
}
