<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index', 'showLatestPosts']);
    }
    
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
        $newPost->user_id = auth()->user()->id;
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
        if ($this->checkPermission($post->user_id)) {
            return view('posts.edit')->with('post', $post);
        } else {
            return redirect('/posts')->with('error', 'Ошибка доступа');
        }
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
        if ($this->checkPermission($deletePost->user_id)) {
            $this->deleteImage($deletePost);
            $deletePost->delete();
            return redirect('/posts')->with('success', 'Запись удалена');
        } else {
            return redirect('/posts')->with('error', 'Ошибка доступа');
        }
    }

    // Удаление изображения в режиме редактирования 
    public function deleteOnlyImage($id) {
        $deleteImagePost = Post::find($id); // Находим
        // Проверяем, принадлежит ли пост данному пользователю
        if ($this->checkPermission($deleteImagePost->user_id)) {
            $this->deleteImage($deleteImagePost); // Удаляем
            $deleteImagePost->save(); // Сохраняем изменения
            return redirect('posts/'.$id.'/edit')->with('success', 'Изображение удалено'); // Редиректимся
        } else {
            return redirect('/posts')->with('error', 'Ошибка доступа');
        }
    }

    // Для главной страницы последние 5 постов
    public function showLatestPosts() {
        $posts = Post::latest()->take(5)->get();

        return view('index')->with('posts', $posts);
    }

    // На странице dashboard отображение постов, созданных текущим пользователем
    public function showDashboard() {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        
        return view('posts.dashboard')->with('posts', $user->posts);
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
        Storage::delete('public/images/'.$post->image);
        $post->image = 'NoImage';
    }

    private function checkPermission($user_id) {
        if ($user_id == auth()->user()->id) {
           return true;
        } else {
            return false;
        }
    }
}
