@auth
    @if ($post->user_id == auth()->user()->id)
        <div class="d-flex flex-row">
            <div class="p-2">
                <a href="/posts/{{$post->id}}/edit/" class="btn btn-success">Редактировать</a>
            </div>
            @include('posts.inc.delete')
        </div>
    @endif
@endauth