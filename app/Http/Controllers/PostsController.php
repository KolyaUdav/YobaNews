<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
        $filenameToStore = 'NoImage';
        if ($request->hasFile('image')) {
            $filenameToStore = $this->uploadImage($request);
        }
        $newPost->image = $filenameToStore;
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
        // echo public_path('images\\'.$post->image);
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
        // Если загружается изображение
        if ($request->hasFile('image')) {
            if ($editPost->image != 'NoImage') {
                $this->deleteImage($editPost);
            }
            $editPost->image = $this->uploadImage($request);
        }
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
        $this->deleteImage($deletePost);
        $deletePost->delete();

        return redirect('/posts')->with('success', 'Запись удалена');
    }

    public function deleteOnlyImage($id) {
        $deleteImagePost = Post::find($id);
        $this->deleteImage($deleteImagePost);
        $deleteImagePost->save();

        return redirect('posts/'.$id.'/edit')->with('success', 'Изображение удалено');
    }

    private function validateForm($request) {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'max:1999|mimes:jpg, png|nullable'
        ]);
    }

    private function uploadImage($request) {
        $filename = rand(1, 10000).'-'.time(); // генерация имени файла
        $extension = $request->file('image')->getClientOriginalExtension(); // получаем расширение файла
        $filenameToStore = $filename.'.'.$extension; // формируем имя файла вместе с расширением
        $image_path = $request->file('image')->storeAs('public/images', $filenameToStore); // сохраняем изображение на сервере
    
        return $filenameToStore; // возвращаем полное имя для сохранения в базе
    }

    private function deleteImage($post) {
        // File::delete('public/images/'.$post->image);
        Storage::delete('public/images/'.$post->image);
        $post->image = 'NoImage';
    }
}
