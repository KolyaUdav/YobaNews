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
    <div  style="margin-top: 10px" class="row">
        @if($post->image != 'NoImage')
            <div class="col-md-4 col-sm-4">
                <img style="width: 100%" src="{{ asset('storage/images/'.$post->image) }}">
            </div>
        @endif
        <div class="col-md-8 col-sm-8">
            <div class="d-flex w-100 justify-content-between">
                <h4 class="mb-1"><b>{{$post->title}}</b></h4>
                <small>{{$post->created_at}}</small>
            </div>
            <p class="mb-1">{{$post->body}}</p>
            <small>User Name</small>
        </div>
    </div>
@endsection