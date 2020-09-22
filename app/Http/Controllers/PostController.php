<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use DebugBar\DebugBar;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return view('public.index')->with(['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create_post');

        return view('public.post_edit_form');
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
        return view('public.post_edit_form')
            ->with(['post' => $post]);
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
     * @return Collection
     */
    public function getPostsForIndexPage()
    {
        $count = config('settings.index_post_chars_limit');
        $result = $this->postsRepository
            ->getPostsForIndex()
            ->load('user')
            ->transform(function ($item) use ($count) {
                if (mb_strlen($item->content) > $count) {
                    $item->content = Str::limit($item->content, $count, '...');
                    $item->is_chopped = true;
                }

                return $item;
            });

        return $result;
    }

    //нахуя а главное зачем я это делал?
    /*public function getPostForEdit(int $id)
    {
        $result = $this->postsRepository->getForEdit($id);

        return $result;
    }*/
}
