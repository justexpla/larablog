<div class="post pl-3 pr-3 pt-3 pb-1 bg-white rounded shadow-sm mb-4 mt-3">
    <strong>Comments!</strong>
    @php $commentaryList = $post->commentaries->groupBy('parent_id') @endphp
    @foreach($commentaryList[""] as $commentary)        @php #костыль TODO: придумать как исправить. Посмотреть реализации других @endphp
        @include('public.blocks.posts.commentary_item', ['commentary' => $commentary])
    @endforeach
</div>
