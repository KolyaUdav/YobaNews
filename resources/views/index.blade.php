@extends('layouts.base')

@section('title')
    {{ config('app.name') }}
@endsection

@section('content')
    @include('posts.inc.posts-list')
@endsection