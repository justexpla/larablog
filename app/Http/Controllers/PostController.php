<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\PostRepository;
use DebugBar\DebugBar;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->postsRepository = app(PostRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->getPostsForIndexPage();
        \Debugbar::info($posts);

        return view('public.index')->with(['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('public.post_edit_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(__METHOD__, $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('public.post_detail', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        dd(__METHOD__);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        dd(__METHOD__);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        dd(__METHOD__);
    }

    /**
     * Получение постов из репозитория и их обработка
     * @return Collection
     */
    public function getPostsForIndexPage()
    {
        $result = $this->postsRepository
            ->getPostsForIndex()
            ->load('user')
            ->transform(function ($item) {
                if (mb_strlen($item->content) > config('settings.index_post_chars_limit')) {
                    $item->content = Str::limit(
                        $item->content,
                        config('settings.index_post_chars_limit'),
                        '...'
                    );
                    $item->is_chopped = true;
                }

                return $item;
            });

        return $result;
    }
}
