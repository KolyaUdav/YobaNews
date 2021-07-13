<div class="list-group">
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div>
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        @if ($post->image != "NoImage")
                            <div class="col-md-4">
                                <img src="{{asset('storage/images/'.$post->image)}}" class="img-fluid rounded-start" alt="...">
                            </div>
                        @endif
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="/posts/{{$post->id}}" class="card-title">{{$post->title}}</a>
                                <p class="card-text">{{Str::limit($post->body, 244)}}</p>
                                <p class="card-text"><small class="text-muted">{{$post->created_at}}</small></p>
                                <p class="card-text"><small class="text-muted">{{$post->user->name}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                @include('posts.inc.adm_btns')
            </div>
        @endforeach
    @else
        <h1>Новостей нет</h1>
    @endif
</div>