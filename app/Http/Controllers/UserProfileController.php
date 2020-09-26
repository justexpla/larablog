<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class UserProfileController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->postsRepository = app(PostRepository::class);
    }

    public function show(User $user)
    {
        $this->setPageTitle($user->name);
        $posts = $this->getPostByUser($user->id);
        return $this->renderOutput('public.user_profile')->with(['user' => $user, 'posts' => $posts]);
    }

    public function getPostByUser(int $id)
    {
        $result = $this->postsRepository->getPostsByUser($id);

        return $result;
    }

    /**
     * #TODO: весь этот пиздец отрефакторить! (ВАЛИДАЦИЯ ГДЕ БЛЯТБб)
     * Получение постов для бесконечной ленты
     * @return array
     * @throws \Throwable
     */
    public function load()
    {
        $posts = $this->getMorePosts(\request()->get('user_id'), \request()->get('page'));
        $htmlOutput = [];

        foreach ($posts as $post) {
            $htmlOutput[] = view('public.blocks.posts.post')->with(['post' => $post])->render();
        }

        return $htmlOutput;
    }

    public function getMorePosts(int $userId, int $page)
    {
        $offset = config('settings.index_post_count') * $page;
        $result = $this->postsRepository->getMorePostsForUser($userId, $offset);

        return $result;
    }

    public function edit(User $user)
    {
        $this->authorize('edit_profile', $user);
        dd(__METHOD__, $user);
    }

    public function update(Request $request, User $user)
    {
        dd(__METHOD__, $user, $request->all());
    }
}
