<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentaryCreateRequest;
use App\Models\Commentary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaryController extends BaseController
{
    /**
     * Сохранение комментария в базу
     * # TODO: проверить без джаваскрипта. Сделать, чтоб работало
     *
     * @param CommentaryCreateRequest $request
     * @return array|\Illuminate\Http\RedirectResponse|Json
     * @throws \Throwable
     */
    public function store(CommentaryCreateRequest $request)
    {
        $data = $request->except('_token');
        $result = Commentary::create($data);

        if ($result) {
            if ($request->ajax()) {
                $htmlOutput = view('public.blocks.posts.commentary_item')
                    ->with(['commentary' => $result])
                    ->render();

                return $htmlOutput;
            } else {
                return back()->with(['message' => 'Success']);
            }
        } else {
            return ['error' => __('post.action_error')];
        }
    }
}
