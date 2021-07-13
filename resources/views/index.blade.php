@extends('layouts.base')

@section('title')
    {{ config('app.name') }}
@endsection

@section('content')
    <h1>Последние новости</h1>
    @include('posts.inc.posts-list')
@endsection