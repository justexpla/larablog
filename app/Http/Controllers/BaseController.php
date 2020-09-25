<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    /**
     * Название страницы
     * @var string $title
     */
    protected $title;

    /**
     * @var PostRepository $postsRepository
     */
    protected $postsRepository;

    public function __construct()
    {
        $this->title = env('APP_NAME');
    }

    /**
     * Метод устанавливает название страницы
     * @param $title
     * @param bool $addAfterTitle
     */
    public function setPageTitle($title, $addAfterTitle = true)
    {
        $this->title = $title;
        if ($addAfterTitle && config('settings.page_title_after')) {
            $this->title .= __(config('settings.page_title_after'));
        }
    }

    /**
     * Возвращает название страницы
     * @return string
     */
    public function getPageTitle()
    {
        return $this->title;
    }

    /**
     * Метод возвращает вьюху с необходимыми переменными
     * @param string $template
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\Response
     */
    public function renderOutput(string $template)
    {
        return view($template)->with(['title' => $this->title]);
    }
}
