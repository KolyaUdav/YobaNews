@extends('layouts.base')

@section('title')
    {{ 'Редактировать новость | YobaNews' }}
@endsection

@section('content')
    <a href="/posts/{{$post->id}}">Назад...</a>
    {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{ Form::label('title', 'Заголовок новости', ['class' => 'form-label']) }}
            {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Введите заголовок']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body', 'Текст новости', ['class' => 'form-label']) }}
            {{ Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Введите текст']) }}
        </div>
        {{ Form::hidden('_method', 'PUT') }}
        <div class="inline">
            <div class="form-group">
                {{ Form::label('image', 'Загрузка изображения (не обязательно)', ['class' => 'form-label']) }}
                {{ Form::file('image', ['class' => 'form-control w-25']) }}
            </div>
            @if($post->image != 'NoImage')
                <div class="edit-image">
                    <div class="col-md-4 col-sm-4">
                        <img style="100%" src="{{ asset('storage/images/'.$post->image) }}">
                    </div>
                </div>
            @endif
        </div>
        {{ Form::submit('Сохранить', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
    @if ($post->image != 'NoImage')
        {!! Form::open(['url' => 'posts/'.$post->id.'/delete-only-image', 'method' => 'POST']) !!}
            <div class="form-group">
                {{ Form::submit('Удалить изображение', ['class' => 'btn btn-danger']) }}
            </div>
            {{ Form::hidden('_method', 'DELETE'); }}
        {!! Form::close() !!}
    @endif
@endsection