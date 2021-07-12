@extends('layouts.base')

@section('title')
    Список новостей | YobaNews
@endsection

@section('content')
    @include('posts.inc.posts-list')
    <hr>
    {{$posts->links()}}
@endsection