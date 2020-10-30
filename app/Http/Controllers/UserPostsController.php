<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\PostRepository;

class UserPostsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->postsRepository = app(PostRepository::class);
    }

    public function index(User $user)
    {
        $posts = $this->getPosts($user->id);

        if (\request()->wantsJson()) {
            $data = $this->renderPostsHtml($posts->items());

            if ($data->count()) {
                return $data->toJson();
            } else {
                return json_encode(['error' => 'no more posts']);
            }
        }
    }

    public function getPosts(int $userId)
    {
        $data = $this->postsRepository
            ->getPosts(['user_id' => $userId]);

        return $data;
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
}
