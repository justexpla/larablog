<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

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

        if (\request()->wantsJson()) {
            $data = $this->renderPostsHtml($posts->items());

            if ($data->count()) {
                return $data->toJson();
            } else {
                return json_encode(['error' => 'no more posts']);
            }
        }

        return $this->renderOutput('public.index')->with(['posts' => $posts]);
    }

    /**
     * Рендер HTML для постов
     *
     * @param $posts
     * @return \Illuminate\Support\Collection
     * @throws \Throwable
     */
    public function renderPostsHtml($posts)
    {
        $renderedPosts = collect();

        foreach ($posts as $post) {
            $postHtml = view('public.blocks.posts.post')->with(['post' => $post])->render();

            $renderedPosts->add($postHtml);
        }

        return $renderedPosts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle(__('post.create'));
        $this->authorize('create_post');

        return $this->renderOutput('public.post_edit_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;

        $post = (new Post())->fill($data);

        $result = $post->save();

        if ($result) {
            return redirect()->route('posts.index')
                ->with(['message' => __('post.created_successful')]);
        } else {
            return back()->withInput()
                ->withErrors([__('post.action_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->setPageTitle($post->title);
        $post->prepareForShow();

        return $this->renderOutput('public.post_detail')->with(['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->setPageTitle(__('post.edit'));
        $this->authorize('edit_post', $post);

        return $this->renderOutput('public.post_edit_form')
            ->with(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $data = $request->except('_token');

        $result = $post->update($data);

        if ($result) {
            return redirect()->route('posts.index')
                ->with(['message' => __('post.updated_successful')]);
        } else {
            return back()->withInput()
                ->withErrors([__('post.action_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('edit_post', $post);
        $result = $post->delete();

        if ($result) {
            return redirect()->route('posts.index')
                ->with(['message' => __('post.deleted_successful')]);
        } else {
            return back()->withInput()
                ->withErrors([__('post.action_error')]);
        }
    }

    /**
     * Получение постов из репозитория и их обработка
     * @return LengthAwarePaginator
     */
    public function getPostsForIndexPage()
    {
        $result = $this->postsRepository
            ->getPosts();

        return $result;
    }
}
