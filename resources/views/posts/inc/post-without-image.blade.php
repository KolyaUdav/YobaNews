<a href="/posts/{{$post->id}}" class="list-group-item list-group-item-action">
    <div class="d-flex justify-content-between">
        <h5 class="mb-1">{{$post->title}}</h5>
        <small class="text-muted">{{$post->created_at}}</small>
    </div>
    <p class="mb-1">{{Str::limit($post->body, 244)}}</p>
    <small class="text-muted">{{$post->user->name}}</small>
</a>