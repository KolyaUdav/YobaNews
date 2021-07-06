<div class='p-2'>
    {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post], 'method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::submit('Удалить', ['class' => 'btn btn-danger']) }}
        </div>
        {{ Form::hidden('_method', 'DELETE') }}
    {!! Form::close() !!}
</div>