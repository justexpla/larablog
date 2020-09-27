<?php

namespace App\Http\Controllers;

use App\Models\Commentary;
use Illuminate\Http\Request;

class CommentaryController extends Controller
{
    public function store(Request $request)
    {
        dd(__METHOD__, $request->all());
    }
}
