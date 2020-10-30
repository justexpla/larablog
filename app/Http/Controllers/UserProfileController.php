<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditProfileRequest;
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

    /**
     * show user
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(User $user)
    {
        $this->setPageTitle($user->name);
        $posts = $this->getPostsByUser($user->id);

        return $this->renderOutput('public.user_profile')->with(['user' => $user, 'posts' => $posts]);
    }

    /**
     * Получить посты пользователя
     * @param int $user_id
     * @return mixed
     */
    public function getPostsByUser(int $user_id)
    {
        $result = $this->postsRepository->getPosts(['user_id' => $user_id], false);

        return $result;
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->setPageTitle(__('user_edit_profile'));
        $this->authorize('edit_profile', $user);

        return $this->renderOutput('public.user_profile_edit')
            ->with(['user' => $user]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UserEditProfileRequest $request, User $user)
    {
        $this->authorize('edit_profile', $user);    #если нужны доп параметры в авторизации, проще сделать так

        $data = $request->except('_token');
        $result = $user->update($data);

        if ($result) {
            return redirect()->route('user.show', $user)
                ->with(['message' => __('misc.user_edit_success')]);
        } else {
            return back()->withErrors(['message' => __('post.action_error')])
                ->withInput();
        }

    }
}
