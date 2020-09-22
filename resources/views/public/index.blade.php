@extends('layouts.app')

@section('content')
    @php /**@var \Illuminate\Database\Eloquent\Collection $posts*/ @endphp
    @foreach($posts as $post)
        @php /**@var \App\Models\Post $post*/ @endphp
        <div class="post pl-3 pr-3 pt-3 pb-1 bg-white rounded shadow-sm mb-4 @if($posts->first()->id === $post->id) mt-3 @endif">
            <div class="text-muted pt-1">
                <div class="post-header mb-1 row">
                    <div class="col-8 d-inline-block">
                        <h3>{{$post->title}}</h3>
                    </div>
                    <div class="col-4 d-inline-block text-right">
                        <div class="author d-inline-block">
                            <div class="small"><a href="#">{{'@'}}{{$post->user->name}}</a></div>
                            <div class="small">{{$post->created_at->diffForHumans()}}</div>
                        </div>
                        <div class="avatar d-inline-block align-top">
                            <img src="https://verimedhealthgroup.com/wp-content/uploads/2019/03/profile-img.jpg"
                                 alt="" width="40" height="40"
                                 class="ml-4">
                        </div>
                    </div>
                </div>
                <div class="post-content mb-1">
                    <div class="border-bottom border-gray border-top pt-3 pb-3">
                        {!! $post->content !!}
                        @if(isset($post->is_chopped) && $post->is_chopped)
                            <div class="text-center">
                                <a href="#">Читать далее...</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="post-bottom row mb-2">
                    <div class="col-6 comments-counter">
                        <a href="# class="ml-1" ">Комментариев: 20</a>
                    </div>
                    <div class="col-6 text-right post-control">
                        <a href="#" class="small ml-2">Редактировать пост</a>
                        <a href="#" class="small ml-2"></a>
                        <a href="#" class="small ml-2">Удалить пост</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
