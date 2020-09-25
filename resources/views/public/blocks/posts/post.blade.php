@php /**@var \App\Models\Post $post*/ @endphp
@php $detailLink = route('posts.show', ['post' => $post->id]); @endphp
<div class="post pl-3 pr-3 pt-3 pb-1 bg-white rounded shadow-sm mb-4 mt-3">
    <div class="text-muted pt-1">
        <div class="post-header mb-1 row">
            <div class="col-8 d-inline-block">
                <a href="{{$detailLink}}"><h3>{{$post->title}}</h3></a>
            </div>
            <div class="col-4 d-inline-block text-right">
                <div class="author d-inline-block">
                    @if($post->user->isBanned())
                        <div class="small"><a href="{{route('user.show', $post->user)}}" style="color: darkgray"><s>{{'@'}}{{$post->user->name}}</s></a></div>
                    @else
                        <div class="small"><a href="{{route('user.show', $post->user)}}">{{'@'}}{{$post->user->name}}</a></div>
                    @endif
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
                        <a href="{{$detailLink}}">Читать далее...</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="post-bottom row mb-2">
            <div class="col-6 comments-counter">
                <a href="{{$detailLink}}" class="ml-1">Комментариев: {{rand(0,100)}} (WIP)</a>
            </div>
            @can('edit_post', $post)
            <div class="col-6 text-right post-control">
                <a href="{{route('posts.edit', $post)}}" class="small ml-2">Редактировать пост</a>
                <form class="d-inline" METHOD="POST" action="{{route('posts.destroy', ['post' => $post])}}">
                    @csrf
                    @method('DELETE')
                    <a href="#" class="small ml-2 destroy-post">Удалить пост</a>
                </form>
            </div>
            @endcan
        </div>
    </div>
</div>
