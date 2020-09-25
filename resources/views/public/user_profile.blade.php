@extends('layouts.app')

@section('content')
    <div class="post pl-3 pr-3 pt-3 pb-1 bg-white rounded shadow-sm mb-4 mt-3">
        <div class="text-muted pt-1">
            <div class="post-header mb-1 row">
                <div class="col-8 d-inline-block">
                    <h4>
                        {{$user->name}}
                    </h4>
                </div>
            </div>
            <div class="post-content mb-1">
                <div class="pt-3 pb-3">
                    <p>Зарегистрирован: {{$user->created_at}}</p>
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
@endsection
