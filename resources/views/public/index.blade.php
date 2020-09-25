@extends('layouts.app')

@section('content')
    @php /**@var \Illuminate\Database\Eloquent\Collection $posts*/ @endphp
    @foreach($posts as $post)
        @include('public.blocks.posts.post')
    @endforeach
    <div class="text-center mb-3 load-more-container">
        <button id="load-more" class="btn btn-primary">Load More</button>
    </div>
@endsection
