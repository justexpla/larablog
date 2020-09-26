@if($posts->count() == config('settings.index_post_count'))
    <div class="text-center mb-3 load-more-container">
        <button id="load-more" class="btn btn-primary" @if(\Route::is('user.show')) data-user="{{$user->id}}" @endif>Load More</button>
    </div>
@endif
