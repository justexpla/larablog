<div class="post pl-3 pr-3 pt-3 pb-1 bg-white rounded shadow-sm mb-4 mt-3">
    <div class="text-muted pt-1">
        <div class="post-header mb-1 row">
            <div class="col-8 d-inline-block">
                <h4 class="d-inline-block">
                    {{$user->name}}
                </h4>
                @can('edit_profile', $user)
                    <a href="{{route('user.edit', $user)}}" class="text-muted small ml-3">Редактировать профиль</a>
                @endcan
                @can('add_to_blacklist', $user)
                    @if(\Auth::user()->hasOnBlackList($user->id))
                        <form action="{{route('settings.blacklist.destroy', $user)}}" method="POST" class="remove-from-blacklist-form d-inline">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('settings.blacklist.destroy', $user)}}" class="text-muted small ml-3 remove-from-blacklist-form_button">Убрать из ЧС</a>
                        </form>
                    @else
                        <form action="{{route('settings.blacklist.store', $user)}}" method="POST" class="add-to-blacklist-form d-inline">
                            @csrf
                            <input type="hidden" name="banned_id" value="{{$user->id}}">
                            <a href="{{route('settings.blacklist.store', $user)}}" class="text-muted small ml-3 add-to-blacklist-form_button">Добавить в ЧС</a>
                        </form>
                    @endif
                @endcan
            </div>
        </div>
        <div class="post-content mb-1">
            <div class="pt-3 pb-3">
                <p>Зарегистрирован: {{$user->created_at->format('d.m.Y')}} <span class="small text-muted">({{$user->created_at->diffForHumans()}})</span></p>
                <p>Роль: {{$user->getUserRoleLabel()}}</p>
            </div>
        </div>
    </div>
</div>

@if($posts->count())
    <div class="post pl-3 pr-3 pt-3 pb-1 bg-white rounded shadow-sm mb-4 mt-3">
        <div class="text-muted pt-1">
            <div class="post-content mb-1">
                <div class="pb-1">
                    <h3>Посты пользователя:</h3>
                </div>
            </div>
        </div>
    </div>
    @foreach($posts as $post)
        @include('public.blocks.posts.post')
    @endforeach
@endif
