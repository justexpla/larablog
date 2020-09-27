<div class="post pl-3 pr-3 pt-3 pb-1 bg-white rounded shadow-sm mb-4 mt-3 commentary-section">
    <strong>Comments!</strong>
    @if($post->commentaries->count())
        @php $commentaryList = $post->commentaries->groupBy('parent_id') @endphp
        @foreach($commentaryList[""] as $commentary)        @php #костыль TODO: придумать как исправить. Посмотреть реализации других @endphp
            @include('public.blocks.posts.commentary_item', ['commentary' => $commentary])
        @endforeach
    @else
        <div class="parent-comment">
            <div class="media text-muted pt-4">
                <div class="media-body pb-3 mb-0 lh-125">
                    <p class="mb-0">{{__('post.no_comments')}}</p>
                </div>
            </div>
        </div>
    @endif

    @include('public.blocks.posts.commentary_edit_form')
</div>
