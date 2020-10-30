@extends('layouts.app')

@section('head')
    <meta name="user_id" content="{{$user->id}}">
@endsection

@section('content')
    @include('public.blocks.user.profile')
    @include('public.blocks.posts.show_more')
@endsection
