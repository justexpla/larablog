<div class="parent-comment" data-commentary-id="{{$commentary->id}}">
    <div class="media text-muted pt-4">
        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
        <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
            <strong class="d-block text-gray-dark pb-2 small"><a href="{{route('user.show', $commentary->user)}}">{{'@'}}{{$commentary->user->name}}</a></strong>
            <p class="mb-0">{{$commentary->content}}</p>
            <div class="comment-control-section mt-1">
                <div>
                    <a href="#" class="small text-muted commentary-reply-button" data-commentary-id="{{$commentary->id}}">Ответить</a>
                </div>
            </div>
        </div>
    </div>
    @if(isset($commentaryList[$commentary->id]))
        @foreach($commentaryList[$commentary->id] as $childCommentary)
            <div class="ml-4 child-comment">
                @include('public.blocks.posts.commentary_item', ['commentary' => $childCommentary])
            </div>
        @endforeach
    @endif
</div>
