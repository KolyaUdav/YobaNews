@extends('layouts.base')

@section('title')
    Ваши посты | YobaNews
@endsection

@section('content')
    <h1>Ваши посты</h1>
    @include('posts.inc.posts-list')
@endsection