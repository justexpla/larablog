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
}
