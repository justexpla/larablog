<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    /**
     * Название страницы
     * @var string $title
     */
    protected $title;
}
