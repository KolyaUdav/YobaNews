@extends('layouts.base')

@section('title')
    {{ 'Редактировать новость | YobaNews' }}
@endsection

@section('content')
    <a href="/posts/{{$post->id}}">Назад...</a>

    <div class="row">
        <div class="col-md-2 col-sm-2">
            @if($post->image != 'NoImage')
                <div style="margin-bottom: 10px">
                    <img width="100%" src="{{ asset('storage/images/'.$post->image) }}">
                </div>
                <div>
                    {!! Form::open(['url' => 'posts/'.$post->id.'/delete-only-image', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{ Form::submit('Удалить', ['class' => 'btn btn-danger form-control w-20']) }}
                        </div>
                        {{ Form::hidden('_method', 'DELETE'); }}
                    {!! Form::close() !!}
                </div>
            @endif
        </div>
        <div class="col-md-10 col-sm-10">
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
                <div class="form-group">
                    {{ Form::label('image', 'Загрузка изображения (не обязательно)', ['class' => 'form-label']) }}
                    {{ Form::file('image', ['class' => 'form-control w-25']) }}
                </div>
                {{ Form::submit('Сохранить', ['class' => 'btn btn-primary form-control w-25', 'style' => 'margin-bottom: 10px;']) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection