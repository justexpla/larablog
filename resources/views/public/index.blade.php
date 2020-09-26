@extends('layouts.app')

@section('content')
    @php /**@var \Illuminate\Database\Eloquent\Collection $posts*/ @endphp
    @foreach($posts as $post)
        @include('public.blocks.posts.post')
    @endforeach
    @include('public.blocks.posts.show_more')
@endsection
