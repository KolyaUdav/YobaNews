@extends('layouts.base')

@section('title')
    {{ 'Добавить новость | YobaNews' }}
@endsection

@section('content')
    {!! Form::open(['action' =>'App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{ Form::label('title', 'Заголовок новости', ['class' => 'form-label']) }}
            {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Введите заголовок']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body', 'Текст новости', ['class' => 'form-label']) }}
            {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Введите текст']) }}
        </div>
        <div class="form-group">
            {{ Form::label('image', 'Загрузка изображения (не обязательно)', ['class' => 'form-label']) }}
            {{ Form::file('image', ['class' => 'form-control w-25']) }}
        </div>
        {{ Form::submit('Сохранить', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection