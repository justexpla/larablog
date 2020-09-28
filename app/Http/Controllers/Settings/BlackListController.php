<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\BaseController;
use App\Models\BlackList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Utils;

class BlackListController extends BaseController
{
    /**
     * Список пользователей в ЧС
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $blackList = Auth::user()->blackList;

        return $this->renderOutput('public.settings_black_list')
            ->with(['blackList' => $blackList]);
    }

    /**
     * Удаление из ЧС
     *
     * @param User $blacklist
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $blacklist)
    {
        /**
         * Костыль для того, чтобы не было путаницы
         * @var User $bannedUser
         */
        $bannedUser = $blacklist;
        $userId = \auth()->user()->id;

        $blackListRecord = BlackList::where(['user_id' => $userId, 'banned_id' => $bannedUser->id]);        #todo: в обсервер

        $result = $blackListRecord->forceDelete();

        if ($result) {
            return back()->with(['success' => __('pages.settings.blacklist.user_removed')]);
        } else {
            return back()->withErrors(['error' => __('post.action_error')]);
        }
    }

    public function store(Request $request, User $bannedUser)
    {
        $data = $request->except(['_token']);
        $data['user_id'] = \auth()->user()->id;

        $result = BlackList::create($data);

        if ($result) {
            return back()->with(['success' => __('pages.settings.blacklist.user_added')]);
        } else {
            return back()->withErrors(['message' => __('post.action_error')]);
        }
    }
}
