@extends('layouts.base')

@section('title')
    Список новостей | YobaNews
@endsection

@section('content')
    <div class="list-group">
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <div>
                    <a href="/posts/{{$post->id}}" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                        @if($post->image != 'NoImage')
                            <img src="{{ asset('storage/images/'.$post->image) }}">
                        @endif
                        <h4 class="mb-1"><b>{{$post->title}}</b></h4>
                        <small>{{$post->created_at}}</small>
                        </div>
                        <p class="mb-1">{{ Str::limit($post->body, 255) }}</p>
                        <small>User Name</small>
                    </a>
                    <div class="d-flex flex-row" id="adminButtons">
                        <div class="p-2">
                            <a href="/posts/{{$post->id}}/edit" class="btn btn-success"> Редактировать</a>
                        </div>
                        @include('posts.inc.delete')
                    </div>
                </div>
            @endforeach
            <hr>
            {{$posts->links()}}
        @else
            <h1>Новостей нет</h1>
        @endif
    </div>
@endsection