@extends('layouts.base')

@section('title')
    {{$post->title}} | YobaNews
@endsection

@section('content')
    <a href="/posts">Назад...</a>
    <div class="d-flex flex-row">
        <div class="p-2">
            <a href="/posts/{{$post->id}}/edit/" class="btn btn-success">Редактировать</a>
        </div>
        @include('posts.inc.delete')
    </div>
    <div class="d-flex w-100 justify-content-between" style="margin-top: 10px">
        <h4 class="mb-1"><b>{{$post->title}}</b></h4>
        <small>{{$post->created_at}}</small>
    </div>
    <p class="mb-1">{{$post->body}}</p>
    <small>User Name</small>
@endsection