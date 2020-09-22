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
    }
}
