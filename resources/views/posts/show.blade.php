@extends('layouts.base')

@section('title')
    {{$post->name}} | YobaNews
@endsection

@section('content')
    <div class="d-flex w-100 justify-content-between" style="margin-top: 10px">
        <h4 class="mb-1"><b>{{$post->title}}</b></h4>
        <small>{{$post->created_at}}</small>
    </div>
    <p class="mb-1">{{$post->body}}</p>
    <small>User Name</small>
@endsection