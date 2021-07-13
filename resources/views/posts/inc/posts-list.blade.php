<div class="list-group">
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div>
                @if($post->image == 'NoImage')
                    @include('posts.inc.post-without-image')
                @else
                    @include('posts.inc.post-with-image')
                @endif

                @include('posts.inc.adm_btns')
            </div>
        @endforeach
    @else
        <h1>Новостей нет</h1>
    @endif
</div>